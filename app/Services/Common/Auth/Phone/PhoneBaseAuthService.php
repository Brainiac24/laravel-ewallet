<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 9:43
 */

namespace App\Services\Common\Auth\Phone;

use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Models\User\UnverifiedUser\UnverifiedUser;
use App\Models\User\User;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Common\Auth\AuthServiceBaseTrait;
use Carbon\Carbon;

abstract class PhoneBaseAuthService
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
    public function isExpiredSendSmsCode($user)
    {
        $now = Carbon::now();
        // проверка времени смс для повторной отправки
        if ($user->sms_code_sent_at === null)
            return;

        $smsCodeSendAt = $this->addWaitingRetrySeconds($user->sms_code_sent_at);
        $diffHuman = $now->diffForHumans($smsCodeSendAt, true);
        if ($now->diffInSeconds($smsCodeSendAt, false) > 0) {
            $wait_seconds = $now->diffInSeconds($this->addWaitingRetrySeconds($user->sms_code_sent_at));
            $error = new  WaitingException(trans('auth.temporary_sms_blocked', ['attribute' => $diffHuman]));
            $error->setAttribute(['meta' => ['wait_seconds' => $wait_seconds]]);

            throw $error;
        }
    }

    /**
     * @param $user
     * @throws TimeoutException
     */
    public function isExpiredSmsCode($user)
    {
        $now = Carbon::now();
        $smsCodeSendAt = $user->sms_code_sent_at->addSeconds(config('auth_api.sms.timeout_confirm_code'));
        if ($now->diffInSeconds($smsCodeSendAt, false) < 0)
            throw new TimeoutException(trans('auth.session_sms_timeout'));
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function checkLimitSmsConfirmTryCount($user)
    {
        if (config('auth_api.sms.confirm_try_count') <= $user->sms_confirm_try_count) {
            $user = $this->blockUser($user);
            throw new WaitingException(trans('auth.temporary_blocked_sms', ['attribute' => Carbon::now()->diffForHumans($user->unblock_at, true)]));
        }
    }

    /**
     * @param UnverifiedUser $user
     * @param string $hashCode
     * @param string $token
     * @param string $deviceId
     * @param bool $platform
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     */
    protected function checkHashSmsCodeByUnverifiedUser(UnverifiedUser $user, string $hashCode, string $token, string $deviceId, bool $platform)
    {
        if (strtolower($hashCode) !== $this->makeHash($token, $user->sms_code, $deviceId, $platform)) {
            $this->unverifiedUserRepository->incrementSmsConfirmTryCount($user);
            $this->checkLimitSmsConfirmTryCount($user);
            throw new ValidationException(trans('auth.failed_sms_code_confirm'));
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
    public function checkHashSmsCodeByUser(User $user, string $hashCode, string $token, string $deviceId, bool $platform)
    {
        if (strtolower($hashCode) !== $this->makeHash($token, $user->sms_code, $deviceId, $platform)) {
            $this->userRepository->incrementSmsConfirmTryCount($user);
            $this->checkLimitSmsConfirmTryCount($user);
            throw new ValidationException(trans('auth.failed_sms_code_confirm'));
        }
    }

    /**
     * @param Carbon $carbon
     * @return Carbon
     */
    protected function addWaitingRetrySeconds(Carbon $carbon): Carbon
    {
        return $carbon->addSeconds(config('auth_api.sms.waiting_to_retry_send'));
    }
}