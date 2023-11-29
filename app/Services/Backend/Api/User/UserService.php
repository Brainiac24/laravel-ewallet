<?php

namespace App\Services\Backend\Api\User;

use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class UserService implements UserServiceContract
{
    public $userRepository;
    public $tempUserRepository;

    public function __construct(UserRepositoryContract $userRepository, TempUserRepositoryContract $tempUserRepository)
    {
        $this->userRepository = $userRepository;
        $this->tempUserRepository = $tempUserRepository;
    }

    public function checkExistTempUser()
    {
        //\Auth::loginUsingId('74016b8a-ba71-11e8-92b3-b06ebfbfa715');
        $user = \Auth::user();
        $tempUser = $this->tempUserRepository->findByMSISDN($user->msisdn);
        if (!empty($tempUser)) {
           
            if (!empty($tempUser->first_name) &&
                        !empty($tempUser->last_name) &&
                        !empty($tempUser->document_type_id) &&
                        !empty($tempUser->country_id) &&
                        !empty($tempUser->country_born_id) &&
                        !empty($tempUser->region_id) &&
                        !empty($tempUser->area_id) &&
                        !empty($tempUser->city_id) &&
                        !empty($tempUser->code_map) &&
                        !empty($tempUser->contacts_json['date_birth']) &&
                        !empty($tempUser->contacts_json['passport']) &&
                        !empty($tempUser->contacts_json['passport_issued_by']) &&
                        !is_null($tempUser->contacts_json['gender']) &&
                        !empty($tempUser->contacts_json['documentCreateDate']) &&
                        (
                            !empty($tempUser->contacts_json['street']) ||
                            !empty($tempUser->contacts_json['house']) ||
                            !empty($tempUser->contacts_json['flat'])
                        )
                    ) {
                        $user->first_name = $tempUser->first_name;
                        $user->last_name = $tempUser->last_name;
                        $user->middle_name = $tempUser->middle_name;
                        $user->document_type_id = $tempUser->document_type_id;
                        $user->country_id = $tempUser->country_id;
                        $user->country_born_id = $tempUser->country_born_id;
                        $user->region_id = $tempUser->region_id;
                        $user->area_id = $tempUser->area_id;
                        $user->city_id = $tempUser->city_id;
                        $user->contacts_json = $tempUser->contacts_json;
                        $user->code_map = $tempUser->code_map;

                        $verificationData['is_verified'] = 2;
                        $verificationData['id'] = (string) Uuid::uuid4();
                        $verificationData['verify_user_id'] = config('app_settings.system_login');
                        $verificationData['verify_user_login'] = config('app_settings.system_login');
                        $verificationData['verify_date'] = (string) Carbon::now();
                        $verificationData['verify_by_system'] = config('app_settings.system_login');
                        $user->verification_params_json = $verificationData;
                    }
            $user->save();
        }
    }

}
