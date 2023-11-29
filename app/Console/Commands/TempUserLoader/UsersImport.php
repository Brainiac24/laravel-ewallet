<?php

namespace App\Console\Commands\TempUserLoader;

use App\Models\TempUser\TempUser;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Container\Container;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class UsersImport implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;
    public $documenTypeRepository;
    public $usersCount = 0;
    public $loadedUsersCount = 0;
    public $notLoadedUsersCount = [];

    /*public function __construct(TempUserRepositoryContract $tempUserRepository)
    {
    parent::__construct();
    $this->tempUserRepository = $tempUserRepository;
    }*/

    public function model(array $row)
    {
        //dd($row[0]);

        $this->tempUserRepository = Container::getInstance()->make(TempUserRepositoryContract::class);
        $this->countryRepository = Container::getInstance()->make(CountryRepositoryContract::class);
        $this->regionRepository = Container::getInstance()->make(RegionRepositoryContract::class);
        $this->areaRepository = Container::getInstance()->make(AreaRepositoryContract::class);
        $this->cityRepository = Container::getInstance()->make(CityRepositoryContract::class);
        $this->documenTypeRepository = Container::getInstance()->make(DocumentTypeRepositoryContract::class);

        if ($this->head) {
            //dd($this->cityRepository->getIdByCodeMap(trim($row[15])));
            if (!empty($row[0])) {
                $tempUser = $this->tempUserRepository->getIdByCodeMap($row[0]);
                
                if ($tempUser == null) {
                    
                    $this->usersCount++;
                    $result = null;

                    $first_name = trim($row[4]);
                    $last_name = trim($row[3]);
                    $middle_name = trim($row[5]);
                    $msisdn = trim($row[35]);
                    $code_map = trim($row[0]);
                    $country_id = $this->countryRepository->getIdByCodeMap(trim($row[17])) ?? null;
                    $country_born_id = $this->countryRepository->getIdByCodeMap(trim($row[23])) ?? null;
                    $region_id = $this->regionRepository->getIdByCodeMap(trim($row[21])) ?? null;
                    $area_id = $this->areaRepository->getIdByCodeMap(trim($row[19])) ?? null;
                    $city_id = $this->cityRepository->getIdByCodeMap(trim($row[15])) ?? null;
                    $document_type_id = $this->documenTypeRepository->getIdByDesc(trim($row[8])) ?? null;
                    $contacts_json['inn'] = trim($row[7]);
                    $contacts_json['date_birth'] = Carbon::parse($row[6])->format('Y-m-d');
                    $contacts_json['gender'] = trim($row[27]) == 'Мужской' ? '1' : '0';
                    $contacts_json['passport'] = trim($row[9]) . trim($row[10]);
                    $contacts_json['passport_issued_by'] = trim($row[11]);
                    $contacts_json['documentCreateDate'] = Carbon::parse($row[12])->format('Y-m-d');
                    $contacts_json['street'] = trim($row[24]);
                    $contacts_json['house'] = trim($row[25]);
                    $contacts_json['flat'] = trim($row[26]);


                    if (!empty($first_name) &&
                        !empty($last_name) &&
                        !empty($document_type_id) &&
                        !empty($country_id) &&
                        !empty($country_born_id) &&
                        !empty($region_id) &&
                        !empty($area_id) &&
                        !empty($city_id) &&
                        !empty($code_map) &&
                        !empty($contacts_json['date_birth']) &&
                        !empty($contacts_json['passport']) &&
                        !empty($contacts_json['passport_issued_by']) &&
                        !is_null($contacts_json['gender']) &&
                        !empty($contacts_json['documentCreateDate']) &&
                            (
                                !empty($contacts_json['street']) ||
                                !empty($contacts_json['house']) ||
                                !empty($contacts_json['flat'])
                            )
                        ) {

                            
                            $this->loadedUsersCount++;
                            $result = new TempUser(
                                [
                                    'id' => (string)Uuid::uuid4(),
                                    'first_name' => $first_name,
                                    'last_name' => $last_name,
                                    'middle_name' => $middle_name,
                                    'msisdn' => $msisdn,
                                    'code_map' => $code_map,
                                    'country_id' => $country_id,
                                    'country_born_id' => $country_born_id,
                                    'region_id' => $region_id,
                                    'area_id' => $area_id,
                                    'city_id' => $city_id,
                                    'document_type_id' => $document_type_id,
                                    'contacts_json' => [
                                        'inn' => $contacts_json['inn'],
                                        'date_birth' => $contacts_json['date_birth'],
                                        'gender' => $contacts_json['gender'],
                                        'passport' => $contacts_json['passport'],
                                        'passport_issued_by' => $contacts_json['passport_issued_by'],
                                        'documentCreateDate' => $contacts_json['documentCreateDate'],
                                        'street' => $contacts_json['street'],
                                        'house' => $contacts_json['house'],
                                        'flat' => $contacts_json['flat'],
                                    ],
                                ]
                            );

                        } else {
                            $this->notLoadedUsersCount[] = 'Номер телефона: ' . $msisdn . ' --- ABS id: '. $code_map . "\n";
                        }

                    return $result;
                }
            }
        }
        $this->head = true;
    }

    public function noHeader()
    {
        $this->head = false;
        return $this;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
