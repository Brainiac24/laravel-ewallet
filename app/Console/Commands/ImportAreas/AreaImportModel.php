<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:21
 */

namespace App\Console\Commands\ImportAreas;


use App\Models\Area\Area;
use App\Models\Bank\Bank;
use App\Models\Country\Country;
use App\Models\Region\Region;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class AreaImportModel implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $areasCount = 0;
    public $loadedAreasCount = 0;
    public $loadedRegionsCount = 0;

    public function model(array $row)
    {
        $regionRepository = \Illuminate\Container\Container::getInstance()->make(RegionRepositoryContract::class);
        $areaRepository = \Illuminate\Container\Container::getInstance()->make(AreaRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $area = $areaRepository->getIdByCodeMap($row[0]);
                $region = $regionRepository->getIdByCodeMap($row[8]);
                //dd($region);
                if ($region == null) {
                    $region_create = $regionRepository->create(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code_map' => trim($row[8]),
                            'name' => 'Неизвестно',
                            'is_active' => '1',
                            'country_id' => "1b3f6684-0a20-4cca-9f4e-fd5744816e02"
                        ]
                    );
                    $region = $regionRepository->getIdByCodeMap(trim($row[8]));

                    $this->loadedRegionsCount++;
                }

                $this->areasCount++;
                if ($area == null) {
                    $this->loadedAreasCount++;
                    return new Area(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'code' => trim($row[15]),
                            'code_map' => trim($row[0]),
                            'name' => trim($row[3]),
                            'desc' => trim($row[1]),
                            'region_id' => $region,
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