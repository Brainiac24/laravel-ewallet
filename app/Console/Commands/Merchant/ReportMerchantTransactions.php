<?php

namespace App\Console\Commands\Merchant;

use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;
use Carbon\Carbon;
use File;
use Illuminate\Console\Command;

class ReportMerchantTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:report-merchant-transactions {start_date} {end_date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $transactionRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TransactionRepositoryContract $transactionRepository,
                                TransactionServiceContract $transactionService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');

        $start_date = null; $end_date = null;

        if(!empty($this->argument('start_date'))) {
            $start_date = Carbon::parse($this->argument('start_date') . ' 00:00:00')->toDateTimeString();
        }
        if(!empty($this->argument('end_date'))) {
            $end_date = Carbon::parse($this->argument('end_date') . ' 23:59:59')->toDateTimeString();
        }

        $transactions = $this->transactionRepository->allForReport(['*'],$start_date, $end_date);
        $data = [];
        foreach ($transactions as $transaction) {

            $merchant_name = '';
            $merchant_id = '';

            //
            if (count($transaction->merchant_item_by_to_account_id)>0) {
                //dd($transaction->merchant_item_by_to_account_id);
                $merchant_id = $transaction->merchant_item_by_to_account_id->merchant['id'];
                $merchant_name = $transaction->merchant_item_by_to_account_id->merchant['name'];
            } elseif (!empty($transaction->merchant_by_to_account_id)) {
                //dd($transaction->merchant_by_to_account_id);
                $merchant_id = $transaction->merchant_by_to_account_id[0]['id'];
                $merchant_name = $transaction->merchant_by_to_account_id[0]['name'];
            }

            if (empty($merchant_id)) {
                $merchant_id = 'null_merchant';
                $merchant_name = 'null_merchant';
            }

            $data_childs = [];

            try {



                $transaction_childs = $transaction->children;

                foreach ($transaction_childs as $transaction_child) {
                    $data_childs[] = [
                        "doc_num" => $transaction_child->session_number,
                        "doc_date" => $transaction_child->finished_at,
                        "amount" => $transaction_child->amount,
                        "service" => $transaction_child->service->name,
                        "from_account_gateway" => ($transaction_child->from_account_without_g_scopes != null ? $transaction_child->from_account_without_g_scopes->account_type->gateway->code  : ""),
                        "from_account" => $this->transactionService->extractAccountNumberValue($transaction_child),
                        "to_account_gateway" => ($transaction_child->to_account_without_g_scopes != null ? $transaction_child->to_account_without_g_scopes->account_type->gateway->code : $transaction_child->service->gateway->code),
                        "to_account" => $this->transactionService->extractAccountNumberValueWithServiceConditions($transaction_child),
                        "status" => $transaction_child->transaction_status->code,
                    ];
                }


                $data[$merchant_id]['transactions'][] = [
                    "doc_num" => $transaction->session_number,
                    "doc_date" => $transaction->finished_at,
                    "amount" => $transaction->amount,
                    "service" => $transaction->service->name,
                    "from_account_gateway" => ($transaction->from_account_without_g_scopes != null ? $transaction->from_account_without_g_scopes->account_type->gateway->code  : ""),
                    "from_account" => $this->transactionService->extractAccountNumberValue($transaction),
                    "to_account_gateway" => ($transaction->to_account_without_g_scopes != null ? $transaction->to_account_without_g_scopes->account_type->gateway->code : $transaction->service->gateway->code),
                    "to_account" => $this->transactionService->extractAccountNumberValueWithServiceConditions($transaction),
                    "status" => $transaction->transaction_status->code,
                    "transaction_childs" => $data_childs,
                ];
                $data[$merchant_id]['name'] = $merchant_name;
            } catch (\Throwable $th) {
                echo $th->getMessage()."\n";
            }
        }

        $baseFilename = "Merchant_transactions_filtered_".Carbon::now()->format("Y_m_d_h_i_s").".csv";
        $filename = self::getFilename($baseFilename);

        $headings = ["Мерчант", "Дата", "Код", "Плательщик", "Операция", "Получатель", "Сумма"];
        $fp = fopen($filename, 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        fputcsv($fp, $headings,";");

        foreach ($data as $merchant) {
            foreach ($merchant["transactions"] as $transaction) {
                fputcsv($fp, [
                    $this->stringFormatCsv($merchant["name"]),
                    $transaction["doc_date"],
                    $this->stringFormatCsv($transaction["doc_num"]),
                    $this->stringFormatCsv($transaction["from_account"]),
                    $this->stringFormatCsv($transaction["service"]),
                    $this->stringFormatCsv($transaction["to_account"]),
                    $this->numberFormatCsv($transaction["amount"]),
                ], ";");

                foreach ($transaction["transaction_childs"] as $transaction_child)
                {
                    fputcsv($fp, [
                        $this->stringFormatCsv($merchant["name"]),
                        $transaction_child["doc_date"],
                        $this->stringFormatCsv($transaction_child["doc_num"]),
                        $this->stringFormatCsv($transaction_child["from_account"]),
                        $this->stringFormatCsv($transaction_child["service"]),
                        $this->stringFormatCsv($transaction_child["to_account"]),
                        $this->numberFormatCsv($transaction_child["amount"]),
                    ], ";");
                }

                fputcsv($fp,array(),";");
            }
        }

        echo "Отчет сформировано: $filename";
    }

    public static function getFilename($baseFilename) : string
    {
        $path = storage_path("export_csv");
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        return $path."/".$baseFilename;
    }

    protected function stringFormatCsv($input)
    {
        if(preg_match("/[0-9]/i", $input)) {
            return '= "' . $input . '"';
        }

        return $input;
    }

    protected function numberFormatCsv($input)
    {
        return number_format($input,4,",","");
    }
}
