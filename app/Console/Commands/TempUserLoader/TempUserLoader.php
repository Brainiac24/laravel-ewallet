<?php

namespace App\Console\Commands\TempUserLoader;

use App\Console\Commands\TempUserLoader\UsersImport;
use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Monolog\Handler\StreamHandler;

class TempUserLoader extends Command
{

    protected $signature = 'command:load-temp-users';

    protected $description = 'Loads temporary users to temp_users table';

    protected $tempUserRepository;
    protected $logger;
    protected $filename = 'ibank_clients.xlsx';
    protected $folderDir = 'load_files';

    public function __construct(TempUserRepositoryContract $tempUserRepository)
    {
        parent::__construct();
        $this->tempUserRepository = $tempUserRepository;

        $this->logger = new \Monolog\Logger($this->signature);
        $folder = 'schedules';
        //$this->logger->pushHandler(new StreamHandler(sprintf('%s/logs/%s/info-%s.log', storage_path(), $folder, \Carbon\Carbon::now()->toDateString()), \Monolog\Logger::INFO));
        //$this->logger->pushHandler(new StreamHandler(sprintf('%s/logs/%s/error-%s.log', storage_path(), $folder, \Carbon\Carbon::now()->toDateString()), \Monolog\Logger::ERROR));
    }

    public function handle()
    {
        $this->logger->info(' Started: ' . __CLASS__);

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600);

        //config(['excel.imports.startRow' => 2]);
        $userModel = (new UsersImport)->noHeader();

        Excel::import($userModel, $this->filename, $this->folderDir);

        //$file = \File::get(storage_path() . config('app_settings.temp_users_path') . '/load_temp_users_1.xlsx');

        echo "counter_users: {$userModel->usersCount} \n";
        echo "counter_loded_users: {$userModel->loadedUsersCount} \n";
        echo "counter_NOT_loded_users: " . count($userModel->notLoadedUsersCount) . " \n";
        echo "NOT_loded_users_array: \n" . implode($userModel->notLoadedUsersCount) . " \n";

        $this->logger->info(' Finished: ' . __CLASS__);
    }
}
