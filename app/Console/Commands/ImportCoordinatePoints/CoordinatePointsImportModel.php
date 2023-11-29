<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:21
 */

namespace App\Console\Commands\ImportCoordinatePoints;


use App\Models\City\City;
use App\Models\CoordinatePoint\CoordinatePoint;
use App\Models\CoordinatePoint\CoordinatePointCity\CoordinatePointCity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Ramsey\Uuid\Uuid;

class CoordinatePointsImportModel implements ToModel, WithBatchInserts
{
    public $head = true;
    public $coordinatePointCount = 0;
    public $loadedCoordinatePointCount = 0;

    public function model(array $row)
    {
        if ($this->head) {
            if (!empty($row[0])) {
                $city = City::where('name', $row[2]??'Душанбе')->first();
                if (empty($city)){
                    $city = City::where('name', 'Душанбе')->first();
                }
                $coordinatePointCity = CoordinatePointCity::firstOrCreate(['city_id' => $city->id], [
                    'id' => (string)Uuid::uuid4(),
                    'city' => $city->id,
                    'version' => 1,
                    'is_active' => 1
                ]);
                $this->coordinatePointCount++;
                $name = trim($row[0]??0);
                $obj_type = (int)trim($row[6]??0);
                if ($obj_type == 2){
                    $name = 'Терминал №'.$name;
                } elseif ($obj_type == 3) {
                    $name = 'Банкомат №'.$name;
                }
                $latitude = trim($row[3]);
                if (trim($row[3]??'') == '-' || empty(trim($row[3]??''))){
                    $latitude = 0;
                }
                $longitude = trim($row[4]??'');
                if (trim($row[4]??'') == '-' || empty(trim($row[4]??''))){
                    $longitude = 0;
                }
                return new CoordinatePoint(
                    [
                        'id' => (string)Uuid::uuid4(),
                        'name' => $name,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'address' => trim($row[1]??''),
                        'coordinate_point_type_id' => trim($row[5]??'04609c1b-9a11-489d-9ec8-96be2949776f'),
                        'is_active' => 1,
                        'object_type' => $obj_type,
                        'coordinate_point_city_id' => $coordinatePointCity->id,
                    ]
                );
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
        return 2000;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 2000;
    }
}