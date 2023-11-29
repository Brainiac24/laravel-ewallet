<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.06.2019
 * Time: 11:18
 */

namespace App\Console\Commands\ImportAccountTypes;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class AccountListAccountTypesImporter extends Command
{
    protected $signature = 'command:import-account_types_account_list';
    protected $description = 'Loads terminal data to account_types (account_list) table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $terminalsAccountTypes = (new AccountListImport())->noHeader();

        Excel::import($terminalsAccountTypes, 'account_types_account_list.xlsx', 'load_files');

        echo "account_types: {$terminalsAccountTypes->terminalsCount} \n";
        echo "account_loaded_types: {$terminalsAccountTypes->loadedTerminalsCount} \n\n";
    }
}