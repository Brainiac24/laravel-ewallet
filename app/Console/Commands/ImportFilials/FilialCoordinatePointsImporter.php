<?php

namespace App\Console\Commands\ImportFilials;

use App\Console\Commands\ImportFilials\FilialsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class FilialCoordinatePointsImporter extends Command
{
    
    protected $signature = 'command:import-filials';

    
    protected $description = 'Loads filials data to coordinate_points table';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        ini_set('memory_limit', '256M');
        $filialsPoint = (new FilialsImport())->noHeader();

        Excel::import($filialsPoint, 'filials.xlsx', 'load_files');

        echo "counter_points: {$filialsPoint->filialsCount} \n";
        echo "counter_loaded_points: {$filialsPoint->loadedFilialsCount} \n\n";
    }
}
