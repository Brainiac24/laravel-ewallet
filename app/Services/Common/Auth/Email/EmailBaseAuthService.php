<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:43
 */

namespace App\Services\Common\Auth\Email;

use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Models\User\User;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Auth\AuthServiceBaseTrait;
use Carbon\Carbon;

abstract class EmailBaseAuthService
{
    use AuthServiceBaseTrait;

    protected $unverifiedUserRepository;
    protected $userRepository;

    /**
     * PhoneBaseAuthService constructor.
     * @param UnverifiedUserRepositoryContract $unverifiedUserRepository
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(UnverifiedUserRepositoryContract $unverifiedUserRepository, UserRepositoryContract $userRepository)
    {
        $this->unverifiedUserRepository = $unverifiedUserRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    public function isExpiredSendEmailCode($user)
    {
        $now = Carbon::now();
        // проверка времени смс для повторной отправки
        if ($user->email_code_sent_at !== null) {
            $emailCodeSendAt = $this->addWaitingRetrySeconds($user->email_code_sent_at);
            $diffHuman = $now->diffForHumans($emailCodeSendAt, true);
            if ($now->diffInSeconds($emailCodeSendAt, false) > 0) {
                $wait_seconds = $now->diffInSeconds($this->addWaitingRetrySeconds($user->email_code_sent_at));
                $error = new  WaitingException(trans('auth.temporary_email_blocked', ['attribute' => $diffHuman]));
                $error->setAttribute(['meta' => ['wait_seconds' => $wait_seconds]]);

                throw $error;
            }
        }
    }

    /**
     * @param User $user
     * @param string $email
     * @throws ValidationException
     */
    protected function checkExistEmail(User $user, string $email)
    {
        if ($user->email == $email)
            throw new ValidationException(trans('auth.exist_email'));
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    public function isBlockedSendEmailCode($user)
    {
        $now = Carbon::now();
        if ($now->diffInSeconds($user->email_send_unblock_at, false) > 0)
            throw new WaitingException(trans('auth.temporary_blocked_email', ['attribute' => $now->diffForHumans($user->email_send_unblock_at, true)]));
    }

    /**
     * @param $user
     * @throws TimeoutException
     */
    public function isExpiredEmailCode($user)
    {
        $now = Carbon::now();
        $emailCodeSendAt = $user->email_code_sent_at->addSeconds(config('auth_api.email.timeout_confirm_code'));
        if ($now->diffInSeconds($emailCodeSendAt, false) < 0)
            throw new TimeoutException(trans('auth.session_email_timeout'));
    }

    /**
     * @param User $user
     * @param string $hashCode
     * @param string $token
     * @param string $deviceId
     * @param bool $platform
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     */
    public function checkHashEmailCodeByUser(User $user, string $hashCode, string $token, string $deviceId, bool $platform)
    {
        if (strtolower($hashCode) !== $this->makeHash($token, $user->email_code, $deviceId, $platform)) {
            $this->userRepository->incrementEmailConfirmTryCount($user);
            $this->checkLimitEmailConfirmTryCount($user);
            throw new ValidationException(trans('auth.failed_email_code_confirm'));
        }
    }

    /**
     * @param User $user
     * @param string $hashCode
     * @param string $token
     * @param string $deviceId
     * @param bool $platform
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     */
    public function checkHashEmailCodeByResetUser(User $user, string $hashCode, string $token, string $deviceId, bool $platform)
    {
        if (strtolower($hashCode) !== $this->makeHash($token, $user->email_code, $deviceId, $platform)) {
            $this->userRepository->incrementEmailConfirmTryCount($user);
            $this->checkLimitEmailConfirmTryCountByResetUser($user);
            throw new ValidationException(trans('auth.failed_email_code_confirm'));
        }
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function checkLimitEmailConfirmTryCount($user)
    {
        if (config('auth_api.email.confirm_try_count') <= $user->email_confirm_try_count && $user->email_confirm_try_count % config('auth_api.email.confirm_try_count') == 0) {
            $user = $this->blockEmail($user);
            throw new WaitingException(trans('auth.temporary_blocked_email', ['attribute' => Carbon::now()->diffForHumans($user->email_send_unblock_at, true)]));
        }
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function checkLimitEmailConfirmTryCountByResetUser($user)
    {
        if (config('auth_api.email.confirm_try_count') <= $user->email_confirm_try_count && $user->email_confirm_try_count % config('auth_api.email.confirm_try_count') == 0) {
            $user = $this->blockUser($user);
            throw new WaitingException(trans('auth.temporary_blocked_email', ['attribute' => Carbon::now()->diffForHumans($user->unblock_at, true)]));
        }
    }

    /**
     * @param  object $user
     * @return object
     */
    protected function blockEmail($user)
    {
        $now = Carbon::now();

        $count_block = (int)($user->email_confirm_try_count / config('auth_api.email.confirm_try_count'));

        //$user->sms_confirm_try_count = 0;
        $user->email_send_unblock_at = $now->addMinutes(($count_block * $count_block) * config('auth_api.email.interval_lock'));
        $user->email_confirm_try_at = $now;
        $user->ip = \Request::ip();
        $user->save();

        return $user;
    }

    /**
     * @param Carbon $carbon
     * @return Carbon
     */
    protected function addWaitingRetrySeconds(Carbon $carbon): Carbon
    {
        return $carbon->addSeconds(config('auth_api.email.waiting_to_retry_send'));
    }

    /**
     * @param Carbon $carbon
     * @return Carbon
     */
    protected function addIntervalLockMinute(Carbon $carbon): Carbon
    {
        return $carbon->addMinute(config('auth_api.email.interval_lock'));
    }
}