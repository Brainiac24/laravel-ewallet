<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.06.2019
 * Time: 10:20
 */

namespace App\Console\Commands\ImportBanks;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class BankImporter extends Command
{
    protected $signature = 'command:import-banks';
    protected $description = 'Loads terminal data to banks table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $banks = (new BankImport())->noHeader();

        Excel::import($banks, 'banks.xlsx', 'load_files');

        echo "banks: {$banks->terminalsCount} \n";
        echo "banks_loaded: {$banks->loadedTerminalsCount} \n\n";
    }
}