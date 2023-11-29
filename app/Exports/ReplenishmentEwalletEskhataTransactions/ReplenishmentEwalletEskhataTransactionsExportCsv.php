<?php
namespace App\Exports\ReplenishmentEwalletEskhataTransactions;

use App\Exports\BaseExporterCsv;
use App\Models\Account\AccountHistory\AccountHistory;
use App\Models\Account\AccountHistory\Filters\AccountHistoryFilter;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;


class ReplenishmentEwalletEskhataTransactionsExportCsv extends BaseExporterCsv
{
    protected $accountHistory;
    protected $data = [];

    /**
     * ClientExport constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->accountHistory = new AccountHistory();
        $this->data = $data;
    }

    public function query()
    {
        return $this->accountHistory
            ->select(["*"])
            ->with(
                'account_type',
                'transaction_status.transaction_status_group',
                'transaction_type',
                'user',
                'currency',
                'transaction'
            )
            ->where('account_type_id', \App\Services\Common\Helpers\AccountTypes::EWALLET_ESKHATA)
            ->filterBy(new AccountHistoryFilter($this->data))
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $item->number,
            $this->stringFormatCsv($item->transaction_type->name),
            $this->stringFormatCsv($item->transaction_status->transaction_status_group->name ),
            $this->stringFormatCsv($item->transaction_status->name),
            $this->numberFormatCsv($item->amount),
            $this->numberFormatCsv($item->commission),
            $this->numberFormatCsv($item->balance),
            $this->numberFormatCsv($item->blocked_balance),
            $this->stringFormatCsv(trim($item->currency->name)),
            $this->numberFormatCsv($item->currency_rate_value),
            $this->stringFormatCsv(trim($item->user->msisdn)),
            $this->stringFormatCsv(trim($item->account_type->name)),
            $this->stringFormatCsv(trim($item->transaction->session_number)),
            $item->created_at
        ];
    }

    public function headings(): array
    {
        return [
            trans('accountHistory.backend.table.number'),
            trans('accountHistory.backend.table.transaction_type_id'),
            trans('accountHistory.backend.table.transaction_status_id'),
            trans('accountHistory.backend.table.transaction_status_id'),
            trans('accountHistory.backend.table.amount'),
            trans('accountHistory.backend.table.commission'),
            trans('accountHistory.backend.table.balance'),
            trans('accountHistory.backend.table.blocked_balance'),
            trans('accountHistory.backend.table.currency_id'),
            trans('accountHistory.backend.table.currency_rate_value'),
            trans('accountHistory.backend.table.user_id'),
            trans('accountHistory.backend.table.account_type_id'),
            trans('accountHistory.backend.table.session_number'),
            trans('accountHistory.backend.table.created_at'),
        ];
    }

}