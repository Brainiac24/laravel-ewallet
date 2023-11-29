<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 31.08.2018
 * Time: 13:34
 */

namespace App\Services\Common\Gateway\Identification;

use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;

use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\Identification;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class IdentificationTransport implements identificationContract
{
    protected $identificator;
    protected $user;
    public $documentTypeRepository;
    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;

    public function __construct(UserRepositoryContract $user, 
                                CountryRepositoryContract $countryRepository,
                                RegionRepositoryContract $regionRepository,
                                AreaRepositoryContract $areaRepository,
                                CityRepositoryContract $cityRepository,
                                DocumentTypeRepositoryContract $documentTypeRepository)
    {
        $this->identificator = config('soniyaapi.result_array');
        $this->user = $user;

        $this->documentTypeRepository = $documentTypeRepository;
        $this->countryRepository = $countryRepository;
        $this->regionRepository = $regionRepository;
        $this->areaRepository = $areaRepository;
        $this->cityRepository = $cityRepository;
    }

    public function identificate($data)
    {
        //dd($this->regionRepository->getIdByCodeMap($data['region_id']));
        try {
            $identifyUser = $this->user->findById($data['user_id']);
            if ($identifyUser->attestation_id == Attestation::IDENTIFIED) {
                //ALREADY IDENTIFIED
                $resultArray['status'] = Identification::ALREADY_IDENTIFIED_EXCEPTION;
                $resultArray['message'] = "ALREADY IDENTIFIED. NO NEED REIDENTIFY.";
                $resultArray['data']['msisdn'] = $data['msisdn'];
                return $resultArray;
            }
            if ($identifyUser->verification_params_json['is_verified'] ?? null == 2) {
                //ALREADY TRY TO  IDENTIFY AND NO CONFIRM
                $resultArray['status'] = Identification::WAITING_ACTIVATION;
                $resultArray['message'] = "ALREADY IDENTIFIED. NO VERIFY FROM APP";
                $resultArray['data']['msisdn'] = $data['msisdn'];
                return $resultArray;
            }
            $identifyUser->first_name = $data['first_name'];
            $identifyUser->last_name = $data['last_name'];
            $identifyUser->middle_name = $data['middle_name'];
            $identifyUser->document_type_id = $this->documentTypeRepository->getIdByCodeMap($data['document_type_id']);//---
            $identifyUser->country_id = $this->countryRepository->getIdByCodeMap($data['country_id']);
            $identifyUser->country_born_id = $this->countryRepository->getIdByCodeMap($data['country_born_id']);
            $identifyUser->region_id =  $this->regionRepository->getIdByCodeMap($data['region_id']);//---
            $identifyUser->area_id =  $this->areaRepository->getIdByCodeMap($data['area_id']);//---
            $identifyUser->city_id =  $this->cityRepository->getIdByCodeMap($data['city_id']);//---

            $contactsJson = $identifyUser->contacts_json;
            $contactsJson['inn'] = $data['inn']??null;
            $contactsJson['date_birth'] = $data['date_birth'];
            $contactsJson['passport'] = $data['document_number'];
            $contactsJson['passport_issued_by'] = $data['document_inspected_by'];
            $contactsJson['gender'] = $data['gender'];
            $contactsJson['street'] = $data['street'];
            $contactsJson['house'] = $data['house'];
            $contactsJson['flat'] = $data['flat'];
            $contactsJson['documentCreateDate'] = $data['document_inspected_at'];
            $identifyUser->contacts_json = $contactsJson;
            $verificationData = [];
            $verificationData['is_verified'] = 2;
            $verificationData['next_attestation_status'] = config('app_settings.identified_attestation_id');
            $verificationData['id'] = (string)Uuid::uuid4();
            $verificationData['verify_user_id'] = $data['remote_user_id'];
            $verificationData['verify_user_login'] = $data['remote_user_id'];
            $verificationData['verify_date'] = (string)Carbon::now();
            $verificationData['verify_by_system'] = 'Soniya API';
            $identifyUser->verification_params_json = $verificationData;
            $identifyUser->save();
            $this->identificator['status'] = 0;
            $this->identificator['message'] = 'OK';
            $this->identificator['data']['user_id'] = $data['user_id'];
            return $this->identificator;
        } catch (\Exception $e) {
            //dd($e->getMessage(). $e->getTraceAsString());
            $this->identificator['status'] = Identification::VALIDATION_EXCEPTION;
            $this->identificator['message'] = 'NO SUBSCRIBER INFORMATION FOUND.' . $e->getMessage();
            $this->identificator['data']['msisdn'] = $data['msisdn'];
            return $this->identificator;
        }
    }

    public function check($data)
    {
        try {
            $resultArray = $this->identificator;
            $checkUser = $this->user->findByMSISDN($data['msisdn']);
            if ($checkUser->attestation_id == Attestation::IDENTIFIED) {
                //ALREADY IDENTIFIED
                $resultArray['status'] = Identification::ALREADY_IDENTIFIED_EXCEPTION;
                $resultArray['message'] = "ALREADY IDENTIFIED. NO NEED REIDENTIFY.";
                $resultArray['data']['msisdn'] = $data['msisdn'];
                return $resultArray;
            }
            if ($checkUser->verification_params_json['is_verified'] ?? null == 2) {
                //ALREADY IDENTIFIED
                $resultArray['status'] = Identification::WAITING_ACTIVATION;
                $resultArray['message'] = "ALREADY IDENTIFIED. NO VERIFY FROM APP";
                $resultArray['data']['msisdn'] = $data['msisdn'];
                return $resultArray;
            }

            $contacts = json_decode($checkUser->contacts_json);

            return ['status' => Identification::OK, 'message' => 'Not identified', 'data' => [
                'user_id' => $checkUser->id,
                'type' => 1,
                'msisdn' => $checkUser->msisdn,
                'first_name' => $checkUser->first_name,
                'last_name' => $checkUser->last_name,
                'middle_name' => $checkUser->middle_name,
                'date_birth' => $contacts['date_birth']??'',
                'inn' => $contacts['inn']??'',
                'document_type_id' => $checkUser->document_type_id,
                'document_number' => $contacts['passport']??'',
                'document_inspected_by' => $contacts['passport_issued_by']??'',
                'document_inspected_at' => $checkUser->$contacts['documentCreateDate']??'',
                'citizenship_id' => $checkUser->country_id,
                'region_id' => $checkUser->region_id,
                'area_id' => $checkUser->area_id,
                'city_id' => $checkUser->city_id,
                'street' => $checkUser->$contacts['street']??'',
                'house' => $checkUser->$contacts['house']??'',
                'flat' => $checkUser->$contacts['flat']??'',
                'born' => $checkUser->$contacts['placeOfBirth']??'',
                'gender' => $checkUser->$contacts['gender']??'',
                ]
            ];
        } catch (\Exception $e) {
            return ['status' => Identification::USER_NOT_FOUND_EXCEPTION, 'message' => 'NO SUBSCRIBER INFORMATION FOUND', 'data' => ['msisdn' => $data['msisdn']]];
        }
    }
}
