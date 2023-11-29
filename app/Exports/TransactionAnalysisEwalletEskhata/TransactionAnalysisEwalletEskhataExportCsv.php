<?php


namespace App\Exports\TransactionAnalysisEwalletEskhata;


use App\Exports\BaseExporterCsv;
use App\Models\Account\AccountHistory\AccountHistory;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\Repositories\Backend\ReportAnalysis\ReportAnalysisRepositoryContract;
use App\Services\Common\Helpers\AccountTypes;
use App\Services\Common\Helpers\TransactionStatus;

class TransactionAnalysisEwalletEskhataExportCsv  extends BaseExporterCsv
{
    protected $transaction;
    protected $user;
    protected $accountHistory;
    protected $reportAnalysisRepository;
    protected $data = [];

    /**
     * ClientExport constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->transaction = new Transaction();
        $this->user = new User();
        $this->accountHistory = new AccountHistory();
        $this->data = $data;
        $this->reportAnalysisRepository = \App::make(ReportAnalysisRepositoryContract::class);
    }

    public function store($baseFilename)
    {
        $fp = fopen(self::getFilename($baseFilename), 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        fputcsv($fp, ['Маълумот оид ба гардиши маблағҳои электронӣ тавассути ҳамёнҳои электронии ЧСК "Бонки Эсхата"  барои тарихи '.$this->data['from_created_at'].' - '.$this->data['to_created_at']],";");
        fputcsv($fp, ['Шумораи умумии ҳамёнҳои электронӣ* (адад)','Амалиётҳои воридотӣ','', 'Амалиётҳои содиротӣ'],";");
        fputcsv($fp, $this->headings(),";");
        $data=$this->query();
        fputcsv($fp, $this->map($data),";");

        fclose($fp);
    }

    public function query()
    {
        $countUser = $this->user->isClient()->where('is_auth', 1)->where('created_at', '<=', "{$this->data['to_created_at']} 23:59:59")->count();
        $reportAnalysis = $this->reportAnalysisRepository->getById($this->data['report_analysis_id']);
        if (isset($reportAnalysis->params_json['incomeAccountTypes'])){
            $incomeTransaction = $this->transaction
                ->whereHas("to_account_without_g_scopes", function ($query) use ($reportAnalysis){
                    $query->withoutGlobalScopes()->whereIn("account_type_id", $reportAnalysis->params_json['incomeAccountTypes']);
                });
        }else{
            $incomeTransaction = $this->transaction->whereNotNull('to_account_id');
        }
        $incomeTransactions=$incomeTransaction
            ->whereIn('service_id', $reportAnalysis->params_json['incomeServices']??[])
            ->where('transaction_status_id', TransactionStatus::COMPLETED)
            ->where('created_at', '>=', "{$this->data['from_created_at']} 00:00:00")
            ->where('created_at', '<=', "{$this->data['to_created_at']} 23:59:59")
            ->get(['amount', 'currency_rate_value', 'from_currency_iso_name', 'to_currency_iso_name']);
        $countTransactionsIncome = $incomeTransactions->count();
        $sumTransactionsIncome = $incomeTransactions->sum(function ($item){
            if (in_array($item->from_currency_iso_name, ['USD', 'RUB', 'EUR'])){
                return $item->amount*$item->currency_rate_value;
            }
            return $item->amount;
        });
        if (isset($reportAnalysis->params_json['expenseAccountTypes'])){
            $expenseTransaction = $this->transaction
                ->whereHas("from_account_without_g_scopes", function ($query) use ($reportAnalysis){
                    $query->withoutGlobalScopes()->whereIn("account_type_id", $reportAnalysis->params_json['expenseAccountTypes']);
                });
        }else{
            $expenseTransaction = $this->transaction->whereNotNull('from_account_id');
        }
        $expenseTransactions=$expenseTransaction
            ->whereIn('service_id', $reportAnalysis->params_json['expenseServices']??[])
            ->where('transaction_status_id', TransactionStatus::COMPLETED)
            ->where('created_at', '>=', "{$this->data['from_created_at']} 00:00:00")
            ->where('created_at', '<=', "{$this->data['to_created_at']} 23:59:59")
            ->get(['amount', 'currency_rate_value', 'from_currency_iso_name', 'to_currency_iso_name']);
        $countTransactionsExpense = $expenseTransactions->count();
        $sumTransactionsExpense = $expenseTransactions->sum(function ($item){
            if (in_array($item->from_currency_iso_name, ['USD', 'RUB', 'EUR'])){
                return $item->amount*$item->currency_rate_value;
            }
            return $item->amount;
        });

        return [
            'countUsers' => $countUser,
            'countTransactionsIncome' => $countTransactionsIncome,
            'sumTransactionsIncome' => $sumTransactionsIncome,
            'countTransactionsExpense' => $countTransactionsExpense,
            'sumTransactionsExpense' => $sumTransactionsExpense,
        ];
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
       return [
            $this->numberFormatCsv($item['countUsers']),
            $this->numberFormatCsv($item['countTransactionsIncome']),
            $this->numberFormatCsv($item['sumTransactionsIncome']),
            $this->numberFormatCsv($item['countTransactionsExpense']),
            $this->numberFormatCsv($item['sumTransactionsExpense']),
        ];
    }

    public function headings(): array
    {
        return [
            "",
            "шумора (адад)",
            "ҳаҷм (сомонӣ)",
            "шумора (адад)",
            "ҳаҷм (сомонӣ)",
        ];
    }
}