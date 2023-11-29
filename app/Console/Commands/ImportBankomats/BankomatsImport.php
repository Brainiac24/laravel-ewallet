<?php

namespace App\Console\Commands\ImportBankomats;

use App\Models\CoordinatePoint\CoordinatePoint;
use App\Models\TempUser\TempUser;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointRepositoryContract;
use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Container\Container;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class BankomatsImport implements ToModel, WithBatchInserts
{
    public $head = true;
    public $tempUserRepository = true;
    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;
    public $documenTypeRepository;
    public $bankomatsCount = 0;
    public $loadedBankomatsCount = 0;

    /*public function __construct(TempUserRepositoryContract $tempUserRepository)
    {
    parent::__construct();
    $this->tempUserRepository = $tempUserRepository;
    }*/

    public function model(array $row)
    {

        $this->coordinatePointRepository = Container::getInstance()->make(CoordinatePointRepositoryContract::class);

        if ($this->head) {
            if (!empty($row[0])) {
                $coordinatePoint = $this->coordinatePointRepository->getIdByName($row[0]);
                $this->bankomatsCount++;
                if ($coordinatePoint == null) {
                    if (is_numeric(trim($row[9])) && is_numeric(trim($row[10]))) {
                        $this->loadedBankomatsCount++;
                        return new CoordinatePoint(
                        [
                            'id' => (string)Uuid::uuid4(),
                            'name' => trim($row[2]),
                            'latitude' => trim($row[9]),
                            'longitude' => trim($row[10]),
                            'address' => trim($row[3]),
                            'object_type' => 3, //банкоба
                        ]
                    );
                    }
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
