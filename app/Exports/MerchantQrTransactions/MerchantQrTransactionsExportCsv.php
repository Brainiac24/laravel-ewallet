<?php
namespace App\Exports\MerchantQrTransactions;

use App\Exports\BaseExporterCsv;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;


class MerchantQrTransactionsExportCsv extends BaseExporterCsv
{
    protected $transaction;
    protected $data = [];

    /**
     * ClientExport constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->transaction = new Transaction();
        $this->data = $data;
    }

    public function query()
    {
        return $this->transaction
            ->select(["*"])
            ->filterBy(new TransactionFilter($this->data))
            ->where('service_id', '=', \App\Services\Common\Helpers\Service::MERCHANT)
            ->whereRaw('merchant_item_id IS NOT NULL')
            ->with(
                'service',
                'merchant_item',
                'merchant_item.merchant',
                'merchant_item.merchant.branch',
                'from_account_without_g_scopes',
                'from_account_without_g_scopes.account_type',
                'user',
                'user.attestation',
                'transaction_status',
                'merchant_item.merchant.city'
            )
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->merchant_item->merchant->name),
            $this->stringFormatCsv($item->merchant_item->name),
            $this->stringFormatCsv($item->merchant_item->merchant->city->name ?? ''),
            $this->stringFormatCsv($item->merchant_item->merchant->address),
            $this->stringFormatCsv($item->service->name),
            $this->stringFormatCsv($item->user->fullNameExtendedFormat),
            $this->stringFormatCsv($item->user->msisdn),
            $this->stringFormatCsv(($item->from_account_without_g_scopes->account_type->account_category_type_id == \App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID)?$item->user->msisdn:$item->from_account_without_g_scopes->number),
            $this->stringFormatCsv($item->transaction_status->name),
            $this->stringFormatCsv($item->session_number),
            $this->numberFormatCsv($item->amount),
            $this->numberFormatCsv(isset($item->cashback_form_merchant) ? $item->cashback_form_merchant->amount : 0),
            $this->stringFormatCsv($item->currency_iso_name),
            $item->created_at,
            $item->finished_at,
            $this->stringFormatCsv($item->user->attestation->name),
            $this->stringFormatCsv($item->merchant_item->merchant->branch->name ?? ''),
        ];
    }

    public function headings(): array
    {
        return [
            "Мерчант",
            "Касса",
            "Город",
            "Адресс",
            "Сервис",
            "Создатель(ФИО)",
            "Создатель(номер)",
            "Плательщик/Со счета",
            "Статус",
            "Сессия",
            "Сумма",
            "Кэшбек с мерчанта",
            "Валюта",
            "Дата создания",
            "Дата завершения",
            "Статус Плательщика",
            "Филиал",
        ];
    }

}