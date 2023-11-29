<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:43
 */

namespace App\Services\Common\Auth\Phone;

use App\Events\Frontend\User\UserRegisteredPhoneEvent;
use App\Events\Frontend\User\UserRegisteringPhoneEvent;
use App\Exceptions\Frontend\Api\AccessForbiddenException;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Auth\AuthEntity;
use App\Services\Common\Auth\Helpers\Step;
use App\Services\Common\Auth\Token\Token;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class PhoneAuthService extends PhoneBaseAuthService implements PhoneAuthServiceContract
{
    protected $authEntity;

    /**
     * PhoneAuthService constructor.
     * @param AuthEntity $authEntity
     * @param UnverifiedUserRepositoryContract $unverifiedUserRepository
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(AuthEntity $authEntity, UnverifiedUserRepositoryContract $unverifiedUserRepository, UserRepositoryContract $userRepository)
    {
        parent::__construct($unverifiedUserRepository, $userRepository);
        $this->authEntity = $authEntity;
    }

    /**
     * @param string $token
     * @param string $msisdn
     * @return string
     * @throws LogicException
     * @throws WaitingException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function register(string $token, string $msisdn): string
    {
        \DB::beginTransaction();

        try {
            $payload = $this->getPayload($token, Step::REGISTER_PHONE);

            $userVerified = $this->userRepository->findByMsisdn($msisdn);

            // если юзер зарегистрирован, то генеририем смс код и отправляем
            // в противном случае проверяем временную таблицу(не верифицированных пользователей) на существование пользователя
            if ($userVerified === null) {

                $userUnverified = $this->unverifiedUserRepository->findByMsisdn($msisdn);

                // если временный юзер не зарегистрирован, то регистрируем, генеририем смс код и отправляем
                // в противном случае идет цепочка проверок на
                // блокирование юзера, повторной отправки смс, много ли было попыток отправки смс, много ли было попыток для подтверждения смс кода
                // и если все ok, то после генерием смс код
                if ($userUnverified === null) {
                    isset($payload['data']['device']) ? $this->unverifiedUserRepository->create($msisdn, $payload['data']['device']) : $this->unverifiedUserRepository->create($msisdn, []);
                } else {

                    $this->isUserBlocked($userUnverified);
                    $this->isExpiredSendSmsCode($userUnverified);
                    //if ($userUnverified->sms_code_sent_count>config('auth_api.sms.limit_sms_code_sent_count'))
                    // генерация и отпарвка смс кода
                    $this->unverifiedUserRepository->updateSmsCodeByModel($userUnverified);
                }

            } else {

                if (isset($userVerified->devices_json['app_version']) && Str::startsWith($userVerified->devices_json['app_version'], '2')) {
                    throw new AccessForbiddenException("Доступ запрещен! С вашего номера телефона был вход в новую версию.");
                }

                $this->isActive($userVerified);
                $this->isUserBlocked($userVerified);
                $this->isExpiredSendSmsCode($userVerified);
                // генерация и отпарвка смс кода
                $userVerified = $this->userRepository->updateSmsCodeByModel($userVerified);
            }

            // создание временного токена с занесением в токен номер телефона для последовательности шага
            $payload['data']['step'] = Step::REGISTER_CONFIRM_PHONE;
            $payload['data']['msisdn'] = $msisdn;

            $tokenBuilder = new Token($payload['data']);

            $userVerified === null ?: Event::dispatch(new UserRegisteringPhoneEvent($userVerified));

            \DB::commit();

            return $tokenBuilder->makeTemporaryToken();
        } catch (\PDOException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            throw $exception;
        }
    }


    /**
     * @param string $token
     * @param string $hashCode
     * @return AuthEntity
     * @throws LogicException
     * @throws TimeoutException
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     */
    public function registerConfirm(string $token, string $hashCode): AuthEntity
    {
        \DB::beginTransaction();

        try {
            // получаем полезные данные для проверки шага
            $payload = $this->getPayload($token, Step::REGISTER_CONFIRM_PHONE);
            $msisdn = $payload['data']['msisdn'];
            $is_auth = false;

            $userVerified = $this->userRepository->findByMsisdn($msisdn);

            if ($userVerified === null) {

                $userUnverified = $this->unverifiedUserRepository->findByMsisdn($msisdn);
                if ($userUnverified === null)
                    throw new LogicException('User not found');

                $this->isUserBlocked($userUnverified);
                $this->isExpiredSmsCode($userUnverified);

                if (!isset($payload['data']['device']['platform']) || !isset($payload['data']['device']['id']))
                    throw new LogicException('Platform Device not found');

                $this->checkHashSmsCodeByUnverifiedUser($userUnverified, $hashCode, $token, $payload['data']['device']['id'], $payload['data']['device']['platform']);

                // если код подтверждения правильно введен, то пользователя из временной таблицы переводим на основую таблицу
                // харкод для решении проблемы копирование поля devices_json для удалении ковычек
                $users = array_add(array_except($userUnverified->getAttributes(), ['token', 'devices_json']), 'devices_json', $payload['data']['device']);
                $users = array_add($users, 'attestation_id', config('app_settings.default_attestation_id'));
                $this->userRepository->create($users);
            } else {

                $is_auth = $userVerified->is_auth;
                $this->isActive($userVerified);
                $this->isUserBlocked($userVerified);
                $this->isExpiredSmsCode($userVerified);
                //$this->checkHashSmsCodeByUnverifiedUser($userVerified, $hashCode, $token, $payload['data']['device']['platform']);
                $this->checkHashSmsCodeByUser($userVerified, $hashCode, $token, $payload['data']['device']['id'], $payload['data']['device']['platform']);
                $userVerified = $this->userRepository->saveDeviceByUser($userVerified, $payload['data']['device']);

            }

            // создание временного токена с занесением в токен шага для последовательности запросов
            $payload['data']['step'] = $is_auth === true ? Step::AUTH_PIN : Step::REGISTER_PIN;
            $tokenBuilder = new Token($payload['data']);
            $this->authEntity->setToken($tokenBuilder->makeTemporaryToken());
            $this->authEntity->setIsAuth($is_auth);

            $userVerified === null ?: Event::dispatch(new UserRegisteredPhoneEvent($userVerified));

            \DB::commit();

            return $this->authEntity;
        } catch (\PDOException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            throw $exception;
        }
    }

}