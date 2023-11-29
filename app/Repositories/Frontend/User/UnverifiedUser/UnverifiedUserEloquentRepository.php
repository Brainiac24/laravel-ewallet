<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 13.07.2018
 * Time: 16:58
 */

namespace App\Repositories\Frontend\User\UnverifiedUser;


use App\Models\User\UnverifiedUser\UnverifiedUser;
use App\Notifications\User\SendSmsCodeForConfirm;
use App\Services\Common\Helpers\Helper;
use Carbon\Carbon;

class UnverifiedUserEloquentRepository implements UnverifiedUserRepositoryContract
{
    protected $unverifiedUser;

    /**
     * UnverifiedUserEloquentRepository constructor.
     * @param $unverifiedUser
     */
    public function __construct(UnverifiedUser $unverifiedUser)
    {
        $this->unverifiedUser = $unverifiedUser;
    }

    public function findByMsisdn(string $msisdn): ?UnverifiedUser
    {
        return $this->unverifiedUser->where('msisdn', $msisdn)->first();
    }

    public function create(string $msisdn, array $device): UnverifiedUser
    {
        $user = new UnverifiedUser();
        $user->msisdn = $msisdn;
        $user->sms_code = Helper::generateSmsCode();
        $user->sms_code_sent_at = Carbon::now();
        $user->sms_code_sent_count = $user->sms_code_sent_count + 1;
        $user->devices_json = $device;
        $user->save();

        $user->notify(new SendSmsCodeForConfirm());

        return $user;
    }

    public function updateSmsCodeByModel(UnverifiedUser $user)
    {
        $user->setOldAttributes($user->getAttributes());
        $user->sms_code = Helper::generateSmsCode();
        $user->sms_code_sent_at = Carbon::now();
        $user->sms_code_sent_count = $user->sms_code_sent_count + 1;
        $user->save();

        $user->notify(new SendSmsCodeForConfirm());

        return $user;
    }

    public function incrementSmsConfirmTryCount(UnverifiedUser $user)
    {
        //$user = $this->unverifiedUser->where('msisdn', $msisdn)->first();
        $user->sms_confirm_try_count += 1;
        $user->sms_confirm_try_at = Carbon::now();
        $user->save();
    }
}