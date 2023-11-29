<?php

namespace App\Console\Commands\OneTimeCommands;

use App\Repositories\Backend\User\UserRepositoryContract;
use App\Services\Common\Helpers\Logger\Logger;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateBonusAccountsCommand extends Command
{

    protected $signature = 'command:create_bonus_accounts';
    protected $description = 'Command for creating bonus accounts for all clients';

    protected $accountService;
    protected $userRepository;

    protected $clientsCount;
    protected $createdBonusAccountCount = 0;

    public function __construct(AccountServiceContract $accountService, UserRepositoryContract $userRepository)
    {
        parent::__construct();
        $this->accountService = $accountService;
        $this->userRepository = $userRepository;
        $this->logger = new Logger('commands', 'CREATE_BONUS_ACCOUNTS');
    }

    public function handle()
    {
        $guid = (string) Uuid::uuid4();

        $log = '---------- НАЧАЛО: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        $clients = $this->userRepository->allClients();

        $this->clientsCount = $clients->count();

        $log = "Количество клиентов: {$this->clientsCount}";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        foreach ($clients as $client) {
            $this->createdBonusAccountCount++;

            DB::beginTransaction();
            try {
                $this->accountService->createBonusAccount($client->id);
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                $log = "Ошибка: client_id: {$client->id} ---- {$e->getMessage()} ---- {$e->getTraceAsString()}";
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                echo $log . "\n";
            }
        }

        $log = "Количество созданных бонусных счетов: {$this->createdBonusAccountCount}";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        $log = '---------- КОНЕЦ: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";
    }
}
