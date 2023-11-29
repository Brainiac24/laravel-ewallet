<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2018
 * Time: 16:42
 */

namespace App\Services\Common\Auth\Pin;


use App\Events\Frontend\User\UserAuthenticatedWithPinEvent;
use App\Events\Frontend\User\UserChangedPinEvent;
use App\Events\Frontend\User\UserRegisteredWithPinEvent;
use App\Events\Frontend\User\UserResetPinEvent;
use App\Events\Frontend\User\UserResettingConfirmedPinEvent;
use App\Events\Frontend\User\UserResettingPinEvent;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Backend\Api\User\UserServiceContract;
use App\Services\Common\Auth\AuthEntity;
use App\Services\Common\Auth\Email\EmailAuthService;
use App\Services\Common\Auth\Helpers\Step;
use App\Services\Common\Auth\Phone\PhoneAuthService;
use App\Services\Common\Auth\Token\Token;
use App\Services\Common\Auth\Token\TokenValidator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class PinAuthService extends PinBaseAuthService implements PinAuthServiceContract
{

    protected $authEntity;

    /**
     * PinAuthService constructor.
     * @param $authEntity
     * @param $unverifiedUserRepository
     * @param $userRepository
     */
    public function __construct(AuthEntity $authEntity, UnverifiedUserRepositoryContract $unverifiedUserRepository, UserRepositoryContract $userRepository, UserServiceContract $userService)
    {
        parent::__construct($unverifiedUserRepository, $userRepository, $userService);
        $this->authEntity = $authEntity;
    }

    /**
     * @param string $token
     * @param string $pin
     * @return AuthEntity
     * @throws LogicException
     * @throws WaitingException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\TimeoutException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function register(string $token, string $pin): AuthEntity
    {
        DB::beginTransaction();

        try {

            // проверка токена на валидность и получаем полезные данные для проверки шага
            $payload = $this->getPayload($token, Step::REGISTER_PIN);
            $msisdn = $payload['data']['msisdn'];

            $userVerified = $this->userRepository->findByMsisdn($msisdn);

            if ($userVerified === null)
                throw new LogicException(trans('auth.phone_not_found'));

            $this->isActive($userVerified);
            $this->isUserBlocked($userVerified);
            $this->isTimeoutEnterPinForSms($userVerified);
            // Если все условия верны, то сохраняем пин, получаем авторизаванного юзера и создаем дефолтный счет
            $userVerified = $this->userRepository->savePinByUser($userVerified, $pin);
            $this->createDefaultAccountAndLoginUsingId($userVerified->id);

            // создание основного токена с занесением в токен полезных данных
            if (!isset($payload['data']['device']['id']))
                throw new LogicException(trans('auth.device_not_found'));

            $payload = [
                'user_id' => $userVerified->id,
                'device_id' => $payload['data']['device']['id']
            ];

            $tokenBuilder = new Token($payload);
            $this->authEntity->setAccessToken($tokenBuilder->makeAccessToken());
            $this->authEntity->setAccessTokenExpireIn($tokenBuilder->getExpiration());
            $this->authEntity->setRefreshToken($tokenBuilder->makeRefreshToken());
            $this->authEntity->setRefreshTokenExpireIn($tokenBuilder->getExpiration());

            Event::dispatch(new UserRegisteredWithPinEvent($userVerified, $this->authEntity));

            DB::commit();

            return $this->authEntity;

        } catch (\PDOException $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @param string $hashPin
     * @return AuthEntity
     * @throws ValidationException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     * @throws \App\Exceptions\Frontend\Api\WaitingException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function auth(string $token, string $hashPin): AuthEntity
    {
        DB::beginTransaction();

        try {

            // получаем полезные данные для проверки шага
            $payload = $this->getPayload($token, Step::AUTH_PIN);
            $msisdn = $payload['data']['msisdn'];

            $userVerified = $this->userRepository->findByMsisdn($msisdn);

            if ($userVerified === null)
                throw new LogicException(trans('auth.phone_not_found'));

            $this->isActive($userVerified);
            $this->isUserBlocked($userVerified);
            $this->checkHashPinByUser($userVerified, $hashPin, $token, $payload['data']['device']['id'], $payload['data']['device']['platform']);

            // создание основного токена с занесением в токен полезных данных
            if (!isset($payload['data']['device']['id']))
                throw new LogicException(trans('auth.device_not_found'));

            Auth::loginUsingId($userVerified->id);
            $this->resetBlockCount($userVerified);

            $payload = [
                'user_id' => $userVerified->id,
                'device_id' => $payload['data']['device']['id']
            ];

            $tokenBuilder = new Token($payload);
            $this->authEntity->setAccessToken($tokenBuilder->makeAccessToken());
            $this->authEntity->setAccessTokenExpireIn($tokenBuilder->getExpiration());
            $this->authEntity->setRefreshToken($tokenBuilder->makeRefreshToken());
            $this->authEntity->setRefreshTokenExpireIn($tokenBuilder->getExpiration());

            Event::dispatch(new UserAuthenticatedWithPinEvent($userVerified, $this->authEntity));

            DB::commit();

            return $this->authEntity;

        } catch (WaitingException $exception) {
            DB::commit();
            throw $exception;
        } catch (ValidationException $exception) {
            DB::commit();
            throw $exception;
        } catch (\PDOException $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @return AuthEntity
     * @throws LogicException
     * @throws WaitingException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\UnauthorizedException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function reset(string $token): AuthEntity
    {
        Db::beginTransaction();

        try {

            // получаем полезные данные для проверки шага
            $splitToken = TokenValidator::splitToken($token);
            $payload = $this->getPayload($splitToken);

            // из полезных данных токена получаем user_id, если существует значит идет сброс авторизованного юзера,
            // в противном случае неавторизованного юзера
            if (isset($payload['data']['user_id']) && !empty($payload['data']['user_id'])) {

                $user = $this->userRepository->findById($payload['data']['user_id']);

                if ($user === null)
                    throw new LogicException('User not found');

                //$hashPin = TokenValidator::splitPinFromToken($token);

                $this->checkAccessToken($user, $splitToken);
                //$this->checkHashPinWithBase64($hashPin, $splitToken, $user->pin, $user->devices_json['id'], $user->devices_json['platform']);

            } else {

                if ($payload['data']['step'] !== Step::AUTH_PIN)
                    throw new LogicException('Incorrect step');

                $user = $this->userRepository->findByMsisdn($payload['data']['msisdn']);

                if ($user === null)
                    throw new LogicException(trans('auth.phone_not_found'));
            }

            $this->isActive($user);
            $this->isUserBlocked($user);

            if (empty($user->email)) {
                $phoneAuthService = Container::getInstance()->make(PhoneAuthService::class);
                $phoneAuthService->isExpiredSendSmsCode($user);
                $user = $this->userRepository->updateSmsCodeByModel($user);
            } else {
                $emailAuthService = Container::getInstance()->make(EmailAuthService::class);
                $emailAuthService->isBlockedSendEmailCode($user);
                $user = $this->userRepository->updateEmailCodeByModel($user);
            }

            // создание временного токена с занесением в токен номер телефона для последовательности шага
            $payload['data']['step'] = Step::RESET_CONFIRM_PIN;
            $payload['data']['msisdn'] = $user->msisdn;
            $payload['data']['device']['id'] = $user->devices_json['id'];

            $tokenBuilder = new Token($payload['data']);
            $auth = new AuthEntity();
            $auth->setTemporaryToken($tokenBuilder->makeTemporaryToken());
            $auth->setWaitSeconds(empty($user->email) ? config('auth_api.sms.waiting_to_retry_send') : config('auth_api.email.waiting_to_retry_send'));
            $auth->setTimeoutConfirmCode(empty($user->email) ? config('auth_api.sms.timeout_confirm_code') : config('auth_api.email.timeout_confirm_code'));
            $auth->setMessage(empty($user->email) ? trans('auth.message_confirm_sms') : trans('auth.message_confirm_email', ['attribute' => $user->hidden_email]));

            Event::dispatch(new UserResettingPinEvent($user));

            DB::commit();

            return $auth;

        } catch (\PDOException $exception) {
            DB::rollBack();
            Log::error($exception);
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @param string $hashCode
     * @return string
     * @throws LogicException
     * @throws ValidationException
     * @throws WaitingException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\TimeoutException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function resetConfirm(string $token, string $hashCode): AuthEntity
    {
        DB::beginTransaction();

        try {
            // получаем полезные данные для проверки шага
            $payload = $this->getPayload($token, Step::RESET_CONFIRM_PIN);
            $msisdn = $payload['data']['msisdn'];

            $user = $this->userRepository->findByMsisdn($msisdn);

            if ($user === null)
                throw new LogicException(trans('auth.phone_not_found'));

            $this->isActive($user);
            $this->isUserBlocked($user);

            if (empty($user->email)) {
                $phoneAuthService = Container::getInstance()->make(PhoneAuthService::class);
                $phoneAuthService->isExpiredSmsCode($user);
                $phoneAuthService->checkHashSmsCodeByUser($user, $hashCode, $token, $user->devices_json['id'], $user->devices_json['platform']);
            } else {
                $emailAuthService = Container::getInstance()->make(EmailAuthService::class);
                $emailAuthService->isExpiredEmailCode($user);
                $emailAuthService->checkHashEmailCodeByResetUser($user, $hashCode, $token, $user->devices_json['id'], $user->devices_json['platform']);
            }

            // создание временного токена с занесением в токен номер телефона для последовательности шага
            $payload['data']['step'] = Step::RESET_REGISTER_PIN;
            $payload['data']['msisdn'] = $msisdn;

            $tokenBuilder = new Token($payload['data']);
            $auth = new AuthEntity();
            $auth->setTemporaryToken($tokenBuilder->makeTemporaryToken());
            $auth->setTimeoutToEnterPin(config('auth_api.pin.timeout_to_enter_pin'));
//            $auth->setMessage(empty($user->email) ? trans('auth.message_confirm_sms') : trans('auth.message_confirm_email', ['attribute' => $user->hidden_email]));

            Event::dispatch(new UserResettingConfirmedPinEvent($user));

            DB::commit();

            return $auth;
        } catch (\PDOException $exception) {
            DB::rollBack();
            Log::error($exception);
            throw $exception;
        } catch (ValidationException $exception) {
            DB::commit();
            Log::error($exception);
            throw $exception;
        } catch (WaitingException $exception) {
            DB::commit();
            Log::error($exception);
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @param string $pin
     * @return AuthEntity
     * @throws LogicException
     * @throws WaitingException
     * @throws \App\Exceptions\Frontend\Api\AccessForbiddenException
     * @throws \App\Exceptions\Frontend\Api\TimeoutException
     * @throws \ReallySimpleJWT\Exception\TokenBuilderException
     * @throws \ReallySimpleJWT\Exception\TokenValidatorException
     * @throws \Exception
     */
    public function resetRegister(string $token, string $pin): AuthEntity
    {
        DB::beginTransaction();

        try {
            // проверка токена на валидность и получаем полезные данные для проверки шага
            $payload = $this->getPayload($token, Step::RESET_REGISTER_PIN);
            $msisdn = $payload['data']['msisdn'];

            $user = $this->userRepository->findByMsisdn($msisdn);

            if ($user === null)
                throw new LogicException(trans('auth.phone_not_found'));

            $this->isActive($user);
            $this->isUserBlocked($user);
            empty($user->email) ? $this->isTimeoutEnterPinForSms($user) : $this->isTimeoutEnterPinForEmail($user);
            // Если все условия верны, то сохраняем пин, получаем авторизаванного юзера и создаем дефолтный счет
            $this->userRepository->savePinByUser($user, $pin);

            // создание основного токена с занесением в токен полезных данных
            if (!isset($payload['data']['device']['id']))
                throw new LogicException(trans('auth.device_not_found'));

            Auth::loginUsingId($user->id);
//            $this->resetBlockCount($user);

            $payload = [
                'user_id' => $user->id,
                'device_id' => $payload['data']['device']['id']
            ];

            $tokenBuilder = new Token($payload);
            $this->authEntity->setAccessToken($tokenBuilder->makeAccessToken());
            $this->authEntity->setAccessTokenExpireIn($tokenBuilder->getExpiration());
            $this->authEntity->setRefreshToken($tokenBuilder->makeRefreshToken());
            $this->authEntity->setRefreshTokenExpireIn($tokenBuilder->getExpiration());

            Event::dispatch(new UserResetPinEvent($user, $this->authEntity));

            DB::commit();

            return $this->authEntity;

        } catch (\PDOException $exception) {
            DB::rollBack();
            Log::error($exception);
            throw $exception;
        }
    }

    /**
     * @param string $token
     * @param string $oldHashPin
     * @param string $newPin
     * @return bool
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     */
    public function change($token, string $oldHashPin, string $newPin): bool
    {
        DB::beginTransaction();

        try {

            //$this->isBlockedChangePin(Auth::user());
            $this->checkHashPinByOldPin(Auth::user(), $oldHashPin, $token, Auth::user()->pin, Auth::user()->devices_json['id'], Auth::user()->devices_json['platform']);

            $user = Container::getInstance()->make(UserRepositoryContract::class);
            $user = $user->saveChangePinByUser(Auth::user(), $newPin);

            Event::dispatch(new UserChangedPinEvent($user));

            DB::commit();

            return true;
        } catch (WaitingException $exception) {
            DB::commit();
            throw $exception;
        } catch (ValidationException $exception) {
            DB::commit();
            throw $exception;
        } catch (\PDOException $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

}