<?php

namespace App\Console\Commands\LocationsDataImporter;

use App\Console\Commands\LocationsDataImporter\LocationsDataModel;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class LocationsDataImporter extends Command
{
    
    protected $signature = 'command:import-locations-data';

    
    protected $description = 'Imports locations data from Excel file named: locations.xlsx';

    
    protected $filename = 'locations.xlsx';
    protected $folderDir = 'load_files';


    protected $logger;

    public function __construct()
    {
        parent::__construct();

        $this->logger = new \Monolog\Logger($this->signature);
    }

    
    public function handle()
    {
        $this->logger->info(' Started: ' . __CLASS__);
        
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 300);
        
        $locations = (new LocationsDataModel)->noHeader();

        Excel::import($locations, $this->filename, $this->folderDir);

        echo "counter_countries: {$locations->counterCountries} \n";
        echo "counter_loded_countries: {$locations->counterCountriesLoaded} \n\n";

        echo "counter_regions: {$locations->counterRegions} \n";
        echo "counter_loded_regions: {$locations->counterRegionsLoaded} \n\n";

        echo "counter_areas: {$locations->counterAreas} \n";
        echo "counter_loded_areas: {$locations->counterAreasLoaded} \n\n";

        echo "counter_cities: {$locations->counterCities} \n";
        echo "counter_loded_cities: {$locations->counterCitiesLoaded} \n\n";

        $this->logger->info(' Finished: ' . __CLASS__);
    }

}
