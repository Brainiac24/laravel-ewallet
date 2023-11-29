<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:58
 */

namespace App\Repositories\Frontend\User;


use App\Events\Frontend\User\UserHistory\UserModifiedEvent;
use App\Exceptions\Frontend\Api\ValidationException;
use App\Models\User\User;
use App\Notifications\User\RegisteredTmpEmail;
use App\Notifications\User\SendCodeForResetPin;
use App\Notifications\User\SendSmsCodeForConfirm;
use App\Notifications\User\UnpinnedOldEmail;
use App\Services\Common\Helpers\Events;
use App\Services\Common\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserEloquentRepository implements UserRepositoryContract
{
    protected $user;

    /**
     * UserEloquentRepository constructor.
     * @param $User7
     */
    public function __construct(User $User)
    {
        $this->user = $User;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function findByMsisdn(string $msisdn): ?User
    {
        return $this->user->with('attestation')->where('msisdn', $msisdn)->withoutGlobalScopes()->first();
    }

    public function findByMsisdnAndLockForUpdate(string $msisdn): ?User
    {
        return $this->user->where('msisdn', $msisdn)->withoutGlobalScopes()->lockForUpdate()->first();
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->user->with('attestation')->find($id);
    }

    public function findById(string $id): ?User
    {
        return $this->user->select(['*'])->where('id', $id)->first();
    }

    public function create(array $data): User
    {
        $sms_code_sent_at = empty($data['sms_code_sent_at']) ? null : Carbon::parse($data['sms_code_sent_at'])->subSecond(config('auth_api.sms.timeout_confirm_code'));// уменьшаем время отправки смс, чтобы при сбросе пин-кода не отбивать запрос;

        $user = new User();
        $user->msisdn = $data['msisdn'];
        $user->attestation_id = config('app_settings.default_attestation_id');
        $user->username = $data['msisdn'];
        $user->sms_code = $data['sms_code'];
        $user->sms_code_sent_at = $sms_code_sent_at;
        $user->sms_confirm_try_at = $data['sms_confirm_try_at'];
        $user->is_active = 1;
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function updateSmsCodeByModel(User $user)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->sms_code = $user->id == config('app_settings.test_apple_client_id') ? config('app_settings.default_code_apple') : Helper::generateSmsCode();
        $user->sms_code_sent_at = Carbon::now();
        $user->sms_code_sent_count = $user->sms_code_sent_count + 1;
        $user->save();

        $user->notify(new SendSmsCodeForConfirm());

        return $user;
    }

    public function incrementSmsConfirmTryCount(User $user)
    {
        //$user = $this->User->where('msisdn', $msisdn)->first();
        $user->sms_confirm_try_count += 1;
        $user->sms_confirm_try_at = Carbon::now();
        $user->save();
    }

    public function incrementEmailConfirmTryCount(User $user)
    {
        $user->email_confirm_try_count += 1;
        $user->email_confirm_try_at = Carbon::now();
        $user->save();
    }

    public function incrementPinConfirmTryCount(User $user)
    {
        $user->pin_confirm_try_count += 1;
        $user->pin_confirm_try_at = Carbon::now();
        $user->save();
    }

    public function incrementPinChangeTryCount(User $user)
    {
        $user->pin_change_try_count += 1;
        $user->pin_change_try_at = Carbon::now();
        $user->save();
    }

    public function savePinByUser(User $user, string $pin)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->pin = $user->id == config('app_settings.test_apple_client_id') ? config('app_settings.default_code_apple') : $pin;
        $user->sms_code_sent_at = empty($user->sms_code_sent_at) ? null : $user->sms_code_sent_at->subSecond(config('auth_api.pin.timeout_to_enter_pin'));
        $user->email_code_sent_at = empty($user->email_code_sent_at) ? null : $user->email_code_sent_at->subSecond(config('auth_api.email.timeout_to_enter_pin'));
        $user->blocked_count = 0;
        $user->pin_confirm_try_count = 0;
        $user->is_auth = true;
        $user->save();

        return $user;
    }

    public function saveChangePinByUser(User $user, string $pin)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->pin = $user->id == config('app_settings.test_apple_client_id') ? config('app_settings.default_code_apple') : $pin;;
        $user->pin_change_try_at = Carbon::now();
        $user->pin_change_try_count = 0;
        $user->blocked_count = 0;
        $user->save();

        return $user;
    }

    public function isExistEmail($email)
    {
        $user = $this->user->where('email', $email)->first();

        return $user == null ? false : true;
    }

    public function isExistTmpEmail($email)
    {
        $user = $this->user->where('tmp_email', $email)->first();

        return $user == null ? false : true;
    }

    /**
     * @param User $user
     * @param string $email
     * @return User
     * @throws ValidationException
     */
    public function saveTmpEmailByUser(User $user, string $email)
    {
        if ($this->isExistEmail($email))
            throw new ValidationException(trans('auth.email_pinned_another_client'));

        $user->setOldAttributes($user->getAttributes());
        $user->tmp_email = $email;
        $user->email_code = Helper::generateEmailCode();
        $user->email_code_sent_count += 1;
        $user->email_code_sent_at = Carbon::now();
        $user->save();
        $user->notify(new RegisteredTmpEmail());
        return $user;
    }

    /**
     * @param User $user
     * @param string $email
     * @return User
     * @throws ValidationException
     */
    public function saveEmailByUser(User $user, string $email)
    {
        if ($this->isExistEmail($email))
            throw new ValidationException(trans('auth.email_pinned_another_client'));

        $old_email = $user->email;
        $user->setOldAttributes($user->getAttributes());
        $user->email_confirm_try_count = 0;
        $user->email_confirm_try_at = Carbon::now();
        $user->email_code_sent_at = Carbon::now()->subSecond(config('auth_api.email.timeout_confirm_code'));// уменьшаем время для предотвращение повторной попытки
        $user->tmp_email = null;
        $user->email = $email;
        $user->save();

        if (!empty($old_email))
            $user->notify(new UnpinnedOldEmail($old_email));
        return $user;
    }

    public function updateLastLoginAt(User $user)
    {
        $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();
    }

    public function updateEmailCodeByModel(User $user)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->email_code = $user->id == config('app_settings.test_apple_client_id') ? config('app_settings.default_code_apple') : Helper::generateEmailCode();
        $user->email_code_sent_at = Carbon::now();
        $user->email_code_sent_count += 1;
        $user->save();

        $user->notify(new SendCodeForResetPin());

        return $user;
    }

    public function saveDeviceByUser(User $user, array $device)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->devices_json = $device;
        $user->sms_code_sent_at = Carbon::now()->subSecond(config('auth_api.sms.timeout_confirm_code'));// уменьшаем время отправки смс, чтобы при сбросе пин-кода не отбивать запрос
        $user->save();

        return $user;
    }

    public function update(array $data, $id, $eventCode = null)
    {
        $user = $this->user->find($id);
        //empty($data['password']) ?: $user->password = $data['password'];

        DB::beginTransaction();
        try {
            $user->setOldAttributes($user->getAttributes());
            //dd($data);
            $user->update($data);
            event(new UserModifiedEvent($user, $eventCode ?? Events::USER_PROFILE_UPDATED));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return $user;
    }

    public function setAttestation($user_id, $verification_confirm, $attestation_id = null)
    {
        $user = $this->findById($user_id);
        //dd($user);
        $verification_params_json = $user->verification_params_json;
        $verification_params_json['is_verified'] = (int)$verification_confirm;
        $user->verification_params_json = $verification_params_json;
        $attestation_id == null ?: $user->attestation_id = $attestation_id;
        $user->save();
        return $user;
    }


}