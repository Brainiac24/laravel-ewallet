<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2018
 * Time: 16:42
 */

namespace App\Services\Common\Auth\Pin;


use App\Exceptions\Frontend\Api\LogicException;
use App\Exceptions\Frontend\Api\TimeoutException;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Exceptions\Frontend\Api\WaitingException;
use App\Models\User\User;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Services\Backend\Api\User\UserServiceContract;
use App\Services\Common\Auth\AuthServiceBaseTrait;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Carbon\Carbon;
use Illuminate\Container\Container;

class PinBaseAuthService
{
    use AuthServiceBaseTrait;

    protected $unverifiedUserRepository;
    protected $userRepository;
    protected $userService;

    /**
     * PhoneBaseAuthService constructor.
     * @param UnverifiedUserRepositoryContract $unverifiedUserRepository
     * @param UserRepositoryContract $userRepository
     */
    protected function __construct(UnverifiedUserRepositoryContract $unverifiedUserRepository, UserRepositoryContract $userRepository, UserServiceContract $userService)
    {
        $this->unverifiedUserRepository = $unverifiedUserRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    protected function createDefaultAccountAndLoginUsingId(string $id)
    {
        $authService = Container::getInstance()->make(AccountServiceContract::class);
        \Auth::loginUsingId($id);
        $authService->createDefaultAccount();
        $this->userService->checkExistTempUser();
    }

    /**
     * @param User $user
     * @param string $hashCode
     * @param string $token
     * @param string $deviceId
     * @param bool $platform
     * @throws ValidationException
     * @throws \Exception
     */
    protected function checkHashPinByUser(User $user, string $hashCode, string $token, string $deviceId, bool $platform)
    {
        if (strtolower($hashCode) !== $this->makeHash($token, $user->pin, $deviceId, $platform)) {
            $this->userRepository->incrementPinConfirmTryCount($user);
            $this->checkLimitPinConfirmTryCount($user);
            throw new ValidationException(trans('auth.failed_pin_code_confirm', ['attribute' => $user->pin_confirm_try_count_left]));
        }
    }

    /**
     * @param User $user
     * @param string $hashPin
     * @param string $token
     * @param string $pin
     * @param string $deviceId
     * @param string $platform
     * @throws ValidationException
     * @throws WaitingException
     * @throws \Exception
     */
    protected function checkHashPinByOldPin(User $user, string $hashPin, string $token, string $pin, string $deviceId, string $platform)
    {
        if (strtolower($hashPin) !== $this->makeHash($token, $pin, $deviceId, $platform)) {
            $this->userRepository->incrementPinConfirmTryCount($user);
            $this->checkLimitPinConfirmTryCount($user);
            throw new ValidationException(trans('auth.old_password_incorrectly'));
        }
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function checkLimitPinChangeTryCount($user)
    {
        $pin_change_try_count = config('auth_api.pin.change_try_count');
        if ($pin_change_try_count <= $user->pin_change_try_count && $user->pin_change_try_count % $pin_change_try_count == 0) {
            $user = $this->blockChangePin($user);
            throw new WaitingException(trans('auth.temporary_blocked_pin', ['attribute' => Carbon::now()->diffForHumans($user->pin_change_unblock_at, true)]));
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    protected function blockChangePin(User $user)
    {
        $now = Carbon::now();

        $count_block = (int)($user->pin_change_try_count / config('auth_api.pin.change_try_count'));

        $user->pin_change_unblock_at = $now->addMinutes(($count_block * $count_block) * config('auth_api.pin.interval_lock'));
        $user->pin_change_try_at = $now;
        $user->ip = \Request::ip();
        $user->save();

        return $user;
    }

    /**
     * @param $user
     * @throws WaitingException
     */
    protected function isBlockedChangePin($user)
    {
        $now = Carbon::now();
        if ($now->diffInSeconds($user->pin_change_unblock_at, false) > 0)
            throw new WaitingException(trans('auth.temporary_blocked_pin', ['attribute' => $now->diffForHumans($user->pin_change_unblock_at, true)]));
    }

    /**
     * @param $user
     * @throws LogicException
     * @throws TimeoutException
     */
    protected function isTimeoutEnterPinForSms($user)
    {
        $now = Carbon::now();
        $timeout = config('auth_api.pin.timeout_to_enter_pin') + config('auth_api.sms.timeout_confirm_code');

        if (empty($timeout))
            throw new LogicException('sms timeout is 0');

        $smsCodeSendAt = $user->sms_code_sent_at->addSeconds($timeout);
        if ($now->diffInSeconds($smsCodeSendAt, false) < 0)
            throw new TimeoutException(trans('auth.session_enter_pin_timeout'));
    }

    /**
     * @param $user
     * @throws TimeoutException
     */
    protected function isTimeoutEnterPinForEmail($user)
    {
        $now = Carbon::now();

        $smsCodeSendAt = $user->email_code_sent_at->addSeconds(config('auth_api.email.timeout_to_enter_pin'));
        if ($now->diffInSeconds($smsCodeSendAt, false) < 0)
            throw new TimeoutException(trans('auth.session_enter_pin_timeout'));
    }

}