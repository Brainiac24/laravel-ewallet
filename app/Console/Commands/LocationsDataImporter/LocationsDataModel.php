<?php

namespace App\Console\Commands\LocationsDataImporter;

use App\Models\Area\Area;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\Region\Region;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use Illuminate\Container\Container;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class LocationsDataModel implements ToCollection, WithBatchInserts
{
    public $countryRepository;
    public $regionRepository;
    public $areaRepository;
    public $cityRepository;

    private $countries_arr = [];
    private $regions_arr = [];
    private $areas_arr = [];
    private $cities_arr = [];

    private $countries = [];
    private $regions = [];
    private $areas = [];
    private $cities = [];

    public $counterCountries = 0;
    public $counterCountriesLoaded = 0;

    public $counterRegions = 0;
    public $counterRegionsLoaded = 0;

    public $counterAreas = 0;
    public $counterAreasLoaded = 0;

    public $counterCities = 0;
    public $counterCitiesLoaded = 0;

    public $head = true;

    public function collection(Collection $rows)
    {

        $this->countryRepository = Container::getInstance()->make(CountryRepositoryContract::class);
        $this->regionRepository = Container::getInstance()->make(RegionRepositoryContract::class);
        $this->areaRepository = Container::getInstance()->make(AreaRepositoryContract::class);
        $this->cityRepository = Container::getInstance()->make(CityRepositoryContract::class);

        foreach ($rows as $row) {
            if ($this->head) {

                if (!empty(trim($row[11])) && !empty($row[16]) && !isset($this->countries_arr[$row[16]])) {
                    $this->countries_arr[trim($row[16])] = (string) Uuid::uuid4();
                    $this->counterCountries++;
                    $country_item = $this->countryRepository->getIdByCodeMap(trim($row[16]));

                    if ($country_item == null) {
                        $this->counterCountriesLoaded++;
                        $item = [
                            'id' => $this->countries_arr[trim($row[16])],
                            'code' => empty(trim($row[14])) ? null : trim($row[14]),
                            'code_map' => trim($row[16]),
                            'name' => trim($row[11]),
                            'iso_2' => trim($row[13]),
                            'iso_3' => trim($row[12]),
                            'desc' => trim($row[15]),
                        ];
                        \array_push($this->countries, $item);
                    }
                }

                if (!empty($row[16]) && trim($row[16]) == '1942801') { //ID - ТАДЖИКИСТАН

                    if (!empty($row[5]) && !isset($this->regions_arr[trim($row[5])])) {
                        $this->regions_arr[trim($row[5])] = (string) Uuid::uuid4();
                        $this->counterRegions++;
                        $regions_item = $this->regionRepository->getIdByCodeMap(trim($row[5]));

                        if ($regions_item == null) {
                            $this->counterRegionsLoaded++;
                            $item = [
                                'id' => $this->regions_arr[trim($row[5])],
                                'code' => empty(trim($row[3])) ? null : trim($row[3]),
                                'code_map' => trim($row[5]),
                                'name' => trim($row[2]),
                                'desc' => trim($row[4]),
                                'country_id' => $this->countries_arr[trim($row[16])],
                            ];

                            \array_push($this->regions, $item);
                        }
                    }

                    if (!empty($row[9]) && !isset($this->areas_arr[trim($row[9])])) {
                        $this->areas_arr[trim($row[9])] = (string) Uuid::uuid4();
                        $this->counterAreas++;
                        $areas_item = $this->areaRepository->getIdByCodeMap(trim($row[9]));

                        if ($areas_item == null) {
                            $this->counterAreasLoaded++;
                            $item = [
                                'id' => $this->areas_arr[trim($row[9])],
                                'code' => empty(trim($row[8])) ? null : trim($row[8]),
                                'code_map' => trim($row[9]),
                                'name' => trim($row[6]),
                                'desc' => trim($row[7]),
                                'region_id' => $this->regions_arr[trim($row[5])],
                            ];

                            \array_push($this->areas, $item);
                        }
                    }

                    if (!empty($this->areas_arr[trim($row[9])]) && !empty($row[23]) && !isset($this->cities_arr[trim($row[23])])) {
                        $this->cities_arr[trim($row[23])] = (string) Uuid::uuid4();
                        $this->counterCities++;
                        $cities_item = $this->cityRepository->getIdByCodeMap(trim($row[23]));

                        if ($cities_item == null) {
                            $this->counterCitiesLoaded++;
                            $item = [
                                'id' => $this->cities_arr[trim($row[23])],
                                'code' => empty(trim($row[23])) ? null : trim($row[23]),
                                'code_map' => trim($row[23]),
                                'name' => trim($row[0]),
                                'area_id' => $this->areas_arr[trim($row[9])],
                            ];

                            \array_push($this->cities, $item);
                        }
                    }
                }
            }
            $this->head = true;
        }

        //dd(array_values($this->regions));

        Country::insert(array_values($this->countries));
        Region::insert(array_values($this->regions));
        Area::insert(array_values($this->areas));
        City::insert(array_values($this->cities));
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
