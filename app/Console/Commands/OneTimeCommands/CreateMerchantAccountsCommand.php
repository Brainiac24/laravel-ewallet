<?php

namespace App\Console\Commands\OneTimeCommands;

use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Services\Common\Helpers\AccountTypes;
use App\Services\Common\Helpers\Logger\Logger;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateMerchantAccountsCommand extends Command
{

    protected $signature = 'command:create_merchant_accounts';
    protected $description = 'Command for creating accounts for all merchants';

    protected $accountService;
    protected $merchantRepository;

    protected $merchantsCount;
    protected $createdTransitAccountsCount = 0;
    protected $createdAccountsCount = 0;

    public function __construct(AccountServiceContract $accountService, MerchantRepositoryContract $merchantRepository)
    {
        parent::__construct();
        $this->accountService = $accountService;
        $this->merchantRepository = $merchantRepository;
        $this->logger = new Logger('commands', 'CREATE_MERCHANT_ACCOUNTS');
    }

    public function handle()
    {
        $guid = (string) Uuid::uuid4();

        $log = '---------- НАЧАЛО: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        $merchants = $this->merchantRepository->allWithoutRelations();

        $this->merchantsCount = $merchants->count();

        $log = "Количество мерчантов: {$this->merchantsCount}";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        foreach ($merchants as $merchant) {

            DB::beginTransaction();

            try {

                if ($merchant->transit_account_id == null || $merchant->account_id == null) {
                    if ($merchant->transit_account_id == null) {
                        $merchant->transit_account_id = $this->accountService->createAccountWithTypeAndUserId(AccountTypes::VIRTUAL_MERCHANT, config('app_settings.default_merchant_user_id'))->id;
                        $this->createdTransitAccountsCount++;
                    }
                    if ($merchant->account_id == null) {
                        $merchant->account_id = $this->accountService->createAccountWithTypeAndUserId(AccountTypes::MERCHANT, config('app_settings.default_merchant_user_id'))->id;
                        $this->createdAccountsCount++;
                    }

                    $merchant->save();
                }
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                $log = "Ошибка: merchant_id: {$merchant->id} ---- {$e->getMessage()} ---- {$e->getTraceAsString()}";
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                echo $log . "\n";
            }
        }

        $log = "Количество созданных транзитных счетов: {$this->createdTransitAccountsCount}";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        $log = "Количество созданных счетов: {$this->createdAccountsCount}";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";

        $log = '---------- КОНЕЦ: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";
        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        echo $log . "\n";
    }
}
