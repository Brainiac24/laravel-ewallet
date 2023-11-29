<?php


namespace App\Exports\SendEmailReportMerchant;


use App\Exports\BaseExporterCsv;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;
use App\Services\Common\Helpers\TransactionStatus;

class SendEmailReportMerchantExportCsv extends BaseExporterCsv
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

    public function store($baseFilename)
    {
        $path = self::getFilename($baseFilename);
        $fp = fopen($path, 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        fputcsv($fp, $this->headings(),";");
        $this->query()->each(function($dt) use($fp)
        {
            fputcsv($fp, $this->map($dt),";");
        }, 10000);

        fclose($fp);

        return [
            'status' => 'success',
            'path' => $path,
            'fileName' => $baseFilename
        ];

    }

    public function query()
    {
        $this->data['transaction_status_id'] = TransactionStatus::COMPLETED;
        return $this->transaction
            ->select(["*"])
            ->filterBy(new TransactionFilter($this->data))
            ->where('service_id', '=', \App\Services\Common\Helpers\Service::MERCHANT)
            ->whereRaw('merchant_item_id IS NOT NULL')
            ->with(
                'service',
                'merchant_item',
                'merchant_item.merchant',
                'transaction_status',
                'merchant_item.merchant.city',
                'cashback_form_merchant'
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
            $this->stringFormatCsv($item->transaction_status->name),
            $this->stringFormatCsv($item->session_number),
            $this->numberFormatCsv($item->amount),
            $this->numberFormatCsv(isset($item->cashback_form_merchant) ? $item->cashback_form_merchant->amount : 0),
            $this->stringFormatCsv($item->currency_iso_name),
            $item->created_at,
            $item->finished_at,
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
            "Статус",
            "Сессия",
            "Сумма",
            "Кэшбек с мерчанта",
            "Валюта",
            "Дата создания",
            "Дата завершения",
        ];
    }

}