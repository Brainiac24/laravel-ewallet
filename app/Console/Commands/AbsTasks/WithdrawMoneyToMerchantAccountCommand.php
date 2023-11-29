<?php

namespace App\Console\Commands\AbsTasks;

use App\Exports\ReportExports\FailedWithdrawToMerchantReportExport;
use App\Exports\ReportExports\SucceedWithdrawToMerchantReportExport;
use App\Services\Backend\Api\Merchant\MerchantService;
use App\Services\Common\Helpers\Logger\Logger;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class WithdrawMoneyToMerchantAccountCommand extends Command
{

    protected $signature = 'command:withdraw_money_to_merchant_account';

    protected $description = 'Command for withdraw money to merchant account';

    protected $merchantService;
    protected $logger;

    const SEND_MERCHANT_WITHDRAW_MONEY_TO_ASP = 6;

    public function __construct(MerchantService $merchantService)
    {
        parent::__construct();
        $this->merchantService = $merchantService;
        $this->logger = new Logger('gateways/asp_callback', 'ASP_CALLBACK_TRANSPORT');
    }

    public function handle()
    {
        ini_set('memory_limit', '999M');

        $guid = (string) Uuid::uuid4();

        $log = '---------- НАЧАЛО: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";

        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        //echo $log . "\n";

        $res = $this->merchantService->withdrawMoneyToMerchantAccount($guid);

        $dateResult = Carbon::now()->format('d-m-Y_H-i-s');
        $succeedFilename = sprintf('Report_SUCCEED_withdraw_money_to_merchant_on_%s_%s.xlsx', $dateResult, $guid);
        $failedFilename = sprintf('Report_FAILED_withdraw_money_to_merchant_on_%s_%s.xlsx', $dateResult, $guid);


        $log =  'Количество успешных выводов средств мерчантов: ' . count($res['succeed']) ;
        $log2 = 'Количество не успешных транзакций мерчантов: ' .count($res['failed']) ;

        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        $this->logger->info($log2 . " ---- СЕССИЯ: " . $guid);
        //echo $log . "\n";
        //echo $log2 . "\n";

        $path = public_path(DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR);
        if (!\File::isDirectory($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (!empty($res['succeed'])) {

            $succeedResult = (new SucceedWithdrawToMerchantReportExport($res['succeed']))->store($succeedFilename, 'merchant_reports');

            if ($succeedResult) {
                $copySucceedResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $succeedFilename, public_path(DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $succeedFilename));
                if (!$copySucceedResult) {
                    $log = "Ошибка при копировании файла отчёта об успешных выводов средств мерчантов";
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                    //echo $log . "\n";
                }
            } else {
                $log = "Ошибка при генерации файла отчёта об успешных выводов средств мерчантов";
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                //echo $log . "\n";
            }

        }

        if (!empty($res['failed'])) {

            $failedResult = (new FailedWithdrawToMerchantReportExport($res['failed']))->store($failedFilename, 'merchant_reports');

            if ($failedResult) {
                $copyFailedResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $failedFilename, public_path(DIRECTORY_SEPARATOR . 'merchant_reports' . DIRECTORY_SEPARATOR . $failedFilename));
                if (!$copyFailedResult) {
                    $log = "Ошибка при копировании файла отчёта об не успешных транзакций мерчантов";
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                    //echo $log . "\n";
                }
            } else {
                $log = "Ошибка при генерации файла отчёта об не успешных транзакций мерчантов";
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                //echo $log . "\n";
            }
        }

        $log = '---------- КОНЕЦ: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";

        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
        //echo $log . "\n";

    }
}
