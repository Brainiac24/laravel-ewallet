<?php

namespace App\Console\Commands\ImportBankomats;

use App\Console\Commands\ImportBankomats\BankomatsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class BankomatCoordinatePointsImporter extends Command
{
    
    protected $signature = 'command:import-bankomats';

    
    protected $description = 'Loads bankomats data to coordinate_points table';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        ini_set('memory_limit', '256M');
        $bankomatsPoint = (new BankomatsImport())->noHeader();

        Excel::import($bankomatsPoint, 'bankomats.xlsx', 'load_files');

        echo "counter_points: {$bankomatsPoint->bankomatsCount} \n";
        echo "counter_loaded_points: {$bankomatsPoint->loadedBankomatsCount} \n\n";
    }
}
