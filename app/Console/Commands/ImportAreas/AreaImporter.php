<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:20
 */

namespace App\Console\Commands\ImportAreas;

use App\Console\Commands\ImportAreas\AreaImportModel;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class AreaImporter extends Command
{
    protected $signature = 'command:import-areas';
    protected $description = 'Loads areas data to table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $areas = (new AreaImportModel())->noHeader();

        Excel::import($areas, 'areas.xlsx', 'load_files');

        echo "loadedAreasCount: {$areas->loadedAreasCount} \n";
        echo "areasAllCount: {$areas->areasCount} \n";
        echo "loadedNewParentRegionsCount: {$areas->loadedRegionsCount} \n\n";
    }
}