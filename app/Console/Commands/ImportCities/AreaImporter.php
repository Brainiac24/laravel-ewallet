<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:20
 */

namespace App\Console\Commands\ImportCities;

use App\Console\Commands\ImportCities\AreaImportModel;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class AreaImporter extends Command
{
    protected $signature = 'command:import-cities';
    protected $description = 'Loads cities data to table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $cities = (new AreaImportModel())->noHeader();

        Excel::import($cities, 'cities.xlsx', 'load_files');

        echo "loadedCitiesCount: {$cities->loadedCitiesCount} \n";
        echo "citiesAllCount: {$cities->citiesCount} \n";
        echo "loadedNewParentAreasCount: {$cities->loadedAreasCount} \n\n";
    }
}