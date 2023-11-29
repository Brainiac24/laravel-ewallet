<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:21
 */

namespace App\Console\Commands\ImportRegions;


use App\Models\Bank\Bank;
use App\Models\Country\Country;
use App\Models\Region\Region;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class RegionImportModel implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $regionsCount = 0;
    public $loadedRegionsCount = 0;
    public $loadedCountriesCount = 0;

    public function model(array $row)
    {
        $regionRepository = \Illuminate\Container\Container::getInstance()->make(RegionRepositoryContract::class);
        $countryRepository = \Illuminate\Container\Container::getInstance()->make(CountryRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $region = $regionRepository->getIdByCodeMap($row[0]);
                $country = $countryRepository->getIdByCodeMap($row[13]);

                if ($country == null) {
                    $country = new Country(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code_map' => trim($row[13]),
                            'name' => 'Неизвестно',
                            'is_active' => '1',
                        ]
                    );
                    $this->loadedCountriesCount++;
                }

                $this->regionsCount++;
                if ($region == null) {
                    $this->loadedRegionsCount++;
                    return new Region(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[1]),
                            'code_map' => trim($row[0]),
                            'name' => trim($row[2]),
                            'desc' => trim($row[3]),
                            'country_id' => $country,
                            'is_active' => '1',
                        ]
                    );
                }
            }
        }
        $this->head = true;
    }

    /**
     * @return $this
     */
    public function noHeader()
    {
        $this->head = false;
        return $this;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}