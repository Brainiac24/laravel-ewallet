<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:20
 */

namespace App\Console\Commands\ImportRegions;


use App\Console\Commands\ImportRegions\RegionImportModel;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class RegionImporter extends Command
{
    protected $signature = 'command:import-regions';
    protected $description = 'Loads regions data to table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $regions = (new RegionImportModel())->noHeader();

        Excel::import($regions, 'regions.xlsx', 'load_files');

        echo "loadedRegionsCount: {$regions->loadedRegionsCount} \n";
        echo "regionsAllCount: {$regions->regionsCount} \n";
        echo "loadedNewParentCountriesCount: {$regions->loadedCountriesCount} \n\n";
    }
}