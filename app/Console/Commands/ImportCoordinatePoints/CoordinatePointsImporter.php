<?php

namespace App\Console\Commands\ImportCoordinatePoints;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class CoordinatePointsImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import_coordinate_points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $coordinatePoints = (new CoordinatePointsImportModel())->noHeader();

        Excel::import($coordinatePoints, 'coordinate_points.xlsx', 'load_files');

        echo "CoordinatePointsAllCount: {$coordinatePoints->coordinatePointCount} \n";
    }
}
