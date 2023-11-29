<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 04.08.2019
 * Time: 16:13
 */

namespace App\Console\Commands\ImportAccountTypes;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class CreditListAccountTypesImporter extends Command
{
    protected $signature = 'command:import-account_types_credit_list';
    protected $description = 'Loads terminal data to account_types (credit_list) table';

   public function __construct()
   {
       parent::__construct();
   }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $terminalsAccountTypes_credit_list = (new CreditListImport())->noHeader();

        Excel::import($terminalsAccountTypes_credit_list, 'account_types_credit_list.xlsx', 'load_files');

        echo "account_types: {$terminalsAccountTypes_credit_list->terminalsCount} \n";
        echo "account_loaded_types: {$terminalsAccountTypes_credit_list->loadedTerminalsCount} \n\n";
    }
}