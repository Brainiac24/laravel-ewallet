<?php

namespace App\Console\Commands\ImportTerminalCoordinatePoints;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class TerminalCoordinatePointsImporter extends Command
{
    
    protected $signature = 'command:import-terminals';

    
    protected $description = 'Loads terminal data to coordinate_points table';

    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function handle()
    {
        ini_set('memory_limit', '256M');
        $terminalsPoint = (new TerminalsImport())->noHeader();

        Excel::import($terminalsPoint, 'terminals.xls', 'load_files');

        echo "counter_points: {$terminalsPoint->terminalsCount} \n";
        echo "counter_loaded_points: {$terminalsPoint->loadedTerminalsCount} \n\n";
    }
}
