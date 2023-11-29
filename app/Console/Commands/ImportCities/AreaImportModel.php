<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:21
 */

namespace App\Console\Commands\ImportCities;

use App\Models\Area\Area;
use App\Models\City\City;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class AreaImportModel implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $citiesCount = 0;
    public $loadedCitiesCount = 0;
    public $loadedAreasCount = 0;

    public function model(array $row)
    {
        $cityRepository = \Illuminate\Container\Container::getInstance()->make(CityRepositoryContract::class);
        $areaRepository = \Illuminate\Container\Container::getInstance()->make(AreaRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $city = $cityRepository->getIdByCodeMap($row[0]);
                $area = $areaRepository->getIdByCodeMap($row[20]);

                if ($area == null) {
                    $area = new Area(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code_map' => trim($row[20]),
                            'name' => 'Неизвестно',
                            'is_active' => '1',
                        ]
                    );
                    $this->loadedAreasCount++;
                }

                $this->citiesCount++;
                if ($city == null) {
                    $this->loadedCitiesCount++;
                    return new City(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[0]),
                            'code_map' => trim($row[0]),
                            'name' => trim($row[1]),
                            //'desc' => trim($row[1]),
                            'area_id' => $area,
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