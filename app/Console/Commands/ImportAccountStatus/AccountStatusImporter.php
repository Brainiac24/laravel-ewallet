<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20.06.2019
 * Time: 14:43
 */

namespace App\Console\Commands\ImportAccountStatus;


use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class AccountStatusImporter extends Command
{
    protected $signature = 'command:import-account_status';
    protected $description = 'Loads terminal data to account_status table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '256M');
        $account_status = (new AccountStatusImport())->noHeader();

        Excel::import($account_status, 'account_status.xlsx', 'load_files');

        echo "account_status: {$account_status->terminalsCount} \n";
        echo "account_status_loaded: {$account_status->loadedTerminalsCount} \n\n";
    }
}