<?php

namespace App\Console\Commands\IdentificateExistedUsers;

use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Backend\Api\User\UserServiceContract;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class IdentificateExistedUsers extends Command
{

    protected $signature = 'command:identificate-existed-users';

    protected $description = 'Identificates existed users from temp_users table';

    public $userService;
    public $userRepository;
    public $tempUserRepository;

    public function __construct(UserServiceContract $userService, UserRepositoryContract $userRepository, TempUserRepositoryContract $tempUserRepository)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->tempUserRepository = $tempUserRepository;
    }

    public function handle()
    {
        //dd($this->userRepository->getNotIdentificatedUsersList());
        $users = $this->userRepository->getNotIdentificatedUsersList();

        $counter_matched = 0;
        $counter_to_verification = 0;
        $counter_error_code_map = [];

        if (!empty($users)) {
            foreach ($users as $user) {
                $tempUser = $this->tempUserRepository->findByMSISDN($user->msisdn);
                if (!empty($tempUser)) {
                    $counter_matched++;

                    $user_by_code_map = $this->userRepository->getUserByCodeMapAndMsisdn($tempUser->code_map, $user->msisdn);
                    if (!empty($user_by_code_map)) {

                        $counter_error_code_map[] = 'code_map: ' . $tempUser->code_map . " - msisdn: " . $user->msisdn;

                    } else {

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

                            $counter_to_verification++;

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

            echo "counter_matched: {$counter_matched} \n";
            echo "counter_to_verification: {$counter_to_verification} \n";
            echo "counter_error_code_map: " . count($counter_error_code_map). "\n";
            echo "counter_error_code_map_data: " . implode(';\n', $counter_error_code_map);

        }
    }
}
