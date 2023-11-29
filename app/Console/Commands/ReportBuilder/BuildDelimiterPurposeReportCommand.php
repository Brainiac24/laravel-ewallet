<?php

namespace App\Console\Commands\ReportBuilder;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Console\Command;
use App\Services\Common\Helpers\Gateway;
use App\Services\Common\Helpers\Service;
use App\Services\Common\Helpers\Logger\Logger;
use App\Exports\ReportExports\DelimiterPurposeReportExporter;
use App\Exports\ReportExports\FailedDelimiterPurposeReportExporter;
use App\Exports\ReportExports\SuccessDelimiterPurposeReportExporter;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;

class BuildDelimiterPurposeReportCommand extends Command
{

    const FROM_ACCOUNT = 0;
    const TO_ACCOUNT = 1;

    protected $signature = 'command:build_delimiter_purpose_report {start_date} {end_date}';

    protected $description = 'Build delimiter purpose report command';

    public $transactionRepository;
    public $transactionService;

    public function __construct(TransactionRepositoryContract $transactionRepository, TransactionServiceContract $transactionService)
    {
        parent::__construct();
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
        $this->logger = new Logger('gateways/reports', 'ASP_CALLBACK_TRANSPORT');
    }


    public function handle()
    {
        //$this->transactionRepository->allByStartDateAndEndDate()

        ini_set('memory_limit', '4096M');

        try {
            $start_date = str_replace("start_date=", "", $this->argument('start_date'));
            $end_date = str_replace("end_date=", "", $this->argument('end_date'));

            echo '---------- НАЧАЛО: ' . Carbon::now()->format('Y-m-d H:i:s') . " ----------";

            $transactions = $this->transactionRepository->allByStartDateAndEndDate($start_date, $end_date);

            echo "\n\nКоличество выбранных транзакций: " . $transactions->count() . " -------- " . Carbon::now()->format('Y-m-d H:i:s');
            $res_success = [];
            $res_failed = [];

            foreach ($transactions as $transaction) {

                try {

                    $res_success[] = [
                        "doc_num" => $transaction->session_number,
                        "doc_date" => $transaction->created_at,
                        "amount" => $transaction->amount_all,
                        "category" => (isset($transaction->service->categories[0]) ? $transaction->service->categories[0]->name : "Платежи и переводы"),
                        "service" => $transaction->service->name,
                        "from_account_gateway" => ($transaction->from_account_without_g_scopes != null ? $transaction->from_account_without_g_scopes->account_type->gateway->code  : ""),
                        "from_account" => $this->transactionService->extractAccountNumberValue($transaction),
                        "to_account_gateway" => ($transaction->to_account_without_g_scopes != null ? $transaction->to_account_without_g_scopes->account_type->gateway->code : $transaction->service->gateway->code),
                        "to_account" => $this->transactionService->extractAccountNumberValueWithServiceConditions($transaction),
                        "status" => $transaction->transaction_status->code,
                    ];
                    
                } catch (\Throwable $th) {
                    $res_failed[] = [
                        "transaction_id" => $transaction->id,
                        "doc_num" => $transaction->session_number,
                        "error_message" => $th->getMessage(),
                        "error_trace" => $th->getTraceAsString(),
                    ];
                }
            }

            echo "\nКоличество успешных выгружаемых транзакций: " . count($res_success) . " -------- " . Carbon::now()->format('Y-m-d H:i:s');
            echo "\nКоличество неуспешных выгружаемых транзакций: " . count($res_failed) . " -------- " . Carbon::now()->format('Y-m-d H:i:s');

            $guid = (string) Uuid::uuid4();
            $dateResult = Carbon::now()->format('d-m-Y_H-i-s');

            $filename_success = sprintf('Report_delimiter_purpose_SUCCEED_on_%s_%s.xlsx', $dateResult, $guid);
            $filename_failed = sprintf('Report_delimiter_purpose_FAILED_on_%s_%s.xlsx', $dateResult, $guid);

            $succeedResult = (new SuccessDelimiterPurposeReportExporter($res_success))->store($filename_success, 'delimiter_purpose_reports');
            $failedResult = (new FailedDelimiterPurposeReportExporter($res_failed))->store($filename_failed, 'delimiter_purpose_reports');

            if ($succeedResult) {
                $copySucceedResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'delimiter_purpose_reports' . DIRECTORY_SEPARATOR . $filename_success, public_path(DIRECTORY_SEPARATOR . 'delimiter_purpose_reports' . DIRECTORY_SEPARATOR . $filename_success));

                if (!$copySucceedResult) {
                    $log = "Ошибка при копировании файла отчёта об успешных назначений транзакций";
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                    echo $log . "\n";
                }
            } else {
                $log = "Ошибка при генерации файла отчёта об успешных назначений транзакций";
                $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                echo $log . "\n";
            }

            if (count($res_failed)>0) {
                if ($failedResult) {
                    $copyFailedResult = \File::copy(storage_path() . DIRECTORY_SEPARATOR . 'delimiter_purpose_reports' . DIRECTORY_SEPARATOR . $filename_failed, public_path(DIRECTORY_SEPARATOR . 'delimiter_purpose_reports' . DIRECTORY_SEPARATOR . $filename_failed));
    
    
                    if (!$copyFailedResult) {
                        $log = "Ошибка при копировании файла отчёта об ошибочных назначений транзакций";
                        $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                        echo $log . "\n";
                    }
                } else {
                    $log = "Ошибка при генерации файла отчёта об ошибочных назначений транзакций";
                    $this->logger->info($log . " ---- СЕССИЯ: " . $guid);
                    echo $log . "\n";
                }
            }
            

            echo "\n\n---------- КОНЕЦ: " . Carbon::now()->format('Y-m-d H:i:s') . " ----------";


        } catch (\Throwable $th) {

            echo $th->getMessage() . "\n";
        }
    }

    
}
