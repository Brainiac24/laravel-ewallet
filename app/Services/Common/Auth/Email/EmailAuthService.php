<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:43
 */

namespace App\Services\Common\Auth\Email;

use App\Events\Frontend\User\UserRegisteredEmailEvent;
use App\Events\Frontend\User\UserRegisteringEmailEvent;
use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use Illuminate\Support\Facades\Event;

class EmailAuthService extends EmailBaseAuthService implements EmailAuthServiceContract
{
    protected $authEntity;

    /**
     * PhoneAuthService constructor.
     * @param UnverifiedUserRepositoryContract $unverifiedUserRepository
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(UnverifiedUserRepositoryContract $unverifiedUserRepository, UserRepositoryContract $userRepository)
    {
        parent::__construct($unverifiedUserRepository, $userRepository);
    }

    /**
     * @param string $email
     * @return bool
     * @throws \App\Exceptions\Frontend\Api\ValidationException
     * @throws \App\Exceptions\Frontend\Api\WaitingException
     * @throws \Exception
     */
    public function register(string $email): bool
    {
        \DB::beginTransaction();

        try {

            $this->checkExistEmail(\Auth::user(), $email);
            $this->isBlockedSendEmailCode(\Auth::user());
            $this->isExpiredSendEmailCode(\Auth::user());

            $user = $this->userRepository->saveTmpEmailByUser(\Auth::user(), $email);

            Event::dispatch(new UserRegisteringEmailEvent($user));

            \DB::commit();

            return true;

        } catch (\PDOException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            throw $exception;
        }

    }

    /**
     * @param string $token
     * @param string $hashCode
     * @return bool
     * @throws \App\Exceptions\Frontend\Api\TimeoutException
     * @throws \App\Exceptions\Frontend\Api\ValidationException
     * @throws \App\Exceptions\Frontend\Api\WaitingException
     * @throws \Exception
     */
    public function registerConfirm(string $token, string $hashCode): bool
    {
        //\DB::beginTransaction();

        try {

            $this->isBlockedSendEmailCode(\Auth::user());
            $this->isExpiredEmailCode(\Auth::user());
            $this->checkHashEmailCodeByUser(\Auth::user(), $hashCode, $token, \Auth::user()->devices_json['id'], \Auth::user()->devices_json['platform']);

            if (\Auth::user()->tmp_email === null)
                throw new LogicException(trans('auth.tmp_email_not_exist'));

            $user = $this->userRepository->saveEmailByUser(\Auth::user(), \Auth::user()->tmp_email);

            Event::dispatch(new UserRegisteredEmailEvent($user));

            \DB::commit();

            return true;

        } catch (\PDOException $exception) {
            \DB::rollBack();
            \Log::error($exception);
            throw $exception;
        }
    }

}