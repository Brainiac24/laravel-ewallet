<?php
namespace App\Exports\Merchant;

use App\Exports\BaseExporterCsv;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\Filters\MerchantFilter;


class MerchantExportCsv extends BaseExporterCsv
{
    protected $merchant;
    protected $data = [];

    /**
     * MerchantExportCsv constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->merchant = new Merchant();
        $this->data = $data;
    }

    public function query()
    {
        return $this->merchant
            ->select("*")
            ->with(['city', 'merchant_commission', 'bank', 'branch','categories','merchant_items'])
            ->filterBy(new MerchantFilter($this->data))
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->name),
            $this->stringFormatCsv($item->organization),
            $this->stringFormatCsv($item->city->name),
            $this->stringFormatCsv($item->address),
            $this->stringFormatCsv($item->branch->name ?? null),
            $this->stringFormatCsv($item->bank->name ?? null),
            $this->stringFormatCsv($item->merchant_commission->name ?? null),
            $this->stringFormatCsv(trans("InterfaceTranses.is_active")[$item->is_active] ?? null),
            $item->created_at,
            $item->contract_date_at??'',
            implode("/",$item->categories->pluck('name')->toArray()),
            $item->merchant_items->count(),
            $this->stringFormatCsv($item->account_number ?? ''),
            $this->stringFormatCsv($item->params_json['referral'] ?? ''),
        ];
    }

    public function headings(): array
    {
        return [
           "Название",
           "Организация",
           "Город",
           "Адрес",
           "Филиал",
           "Банк",
           "Мерчант комисия",
           "Статус",
           "Дата создания",
           "Дата активации",
           "Категория",
           "Количество точек",
           "Расчётный счёт",
           "Реферал",

        ];
    }

}