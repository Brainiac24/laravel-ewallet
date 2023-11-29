<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.06.2019
 * Time: 10:31
 */

namespace App\Console\Commands\ImportAccountTypes;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class DepositListAccountTypesImporter extends Command
{
    protected $signature = 'command:import-account_types_deposit_list';
    protected $description = 'Loads terminal data to account_types (deposit_list) table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $terminalsAccountTypes_deposit_list = (new DepositListImport())->noHeader();

        Excel::import($terminalsAccountTypes_deposit_list, 'account_types_deposit_list.xlsx', 'load_files');

        echo "account_types: {$terminalsAccountTypes_deposit_list->terminalsCount} \n";
        echo "account_loaded_types: {$terminalsAccountTypes_deposit_list->loadedTerminalsCount} \n\n";
    }
}