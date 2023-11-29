<?php
namespace App\Exports\BeetweenEwalletEskhataTransactions;

use App\Exports\BaseExporterCsv;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;


class BeetweenEwalletEskhataTransactionsExportCsv extends BaseExporterCsv
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
            ->with(
                'from_account_without_g_scopes',
                'to_account_without_g_scopes',
                'from_account_without_g_scopes.user_without_g_scopes',
                'to_account_without_g_scopes.user_without_g_scopes',
                'from_account_without_g_scopes.user_without_g_scopes.region',
                'to_account_without_g_scopes.user_without_g_scopes.region',
                'from_account_without_g_scopes.user_without_g_scopes.area',
                'from_account_without_g_scopes.user_without_g_scopes.country',
                'to_account_without_g_scopes.user_without_g_scopes.area',
                'to_account_without_g_scopes.user_without_g_scopes.country'
            )->whereHas("from_account_without_g_scopes", function ($query){
                $query->withoutGlobalScopes()->where("account_type_id", \App\Services\Common\Helpers\AccountTypes::EWALLET_ESKHATA);
            })
            ->where('service_id', \App\Services\Common\Helpers\Service::EWALLET_ESKHATA)
            ->filterBy(new TransactionFilter($this->data))
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        $params_json_collect = collect($item->params_json);

        return [
            $item->created_at,
            $this->numberFormatCsv($item->amount),
            $this->stringFormatCsv($item->getCommentForReport()),

            $this->stringFormatCsv($item->from_account_without_g_scopes->user_without_g_scopes->username ?? ""),
            $this->stringFormatCsv($item->from_account_without_g_scopes->user_without_g_scopes->fullNameExtendedFormat ?? ""),
            trim($item->from_account_without_g_scopes->user_without_g_scopes->contacts_json["date_birth"] ?? ""),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->address ?? "")),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->region->name ?? "")),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->area->name ?? "")),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->document_type->name ?? "")),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->contacts_json['passport'] ?? "")),
            trim($item->from_account_without_g_scopes->user_without_g_scopes->contacts_json["documentCreateDate"] ?? ""),
            $this->stringFormatCsv(trim($item->from_account_without_g_scopes->user_without_g_scopes->country->name ?? "")),

            $this->stringFormatCsv($item->to_account_without_g_scopes->user_without_g_scopes->username ?? ""),
            $this->stringFormatCsv($item->to_account_without_g_scopes->user_without_g_scopes->fullNameExtendedFormat ?? ""),
            trim($item->to_account_without_g_scopes->user_without_g_scopes->contacts_json["date_birth"] ?? ""),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->address ?? "")),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->region->name ?? "")),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->area->name ?? "")),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->document_type->name ?? "")),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->contacts_json['passport'] ?? "")),
            trim($item->to_account_without_g_scopes->user_without_g_scopes->contacts_json["documentCreateDate"] ?? ""),
            $this->stringFormatCsv(trim($item->to_account_without_g_scopes->user_without_g_scopes->country->name ?? ""))
        ];
    }

    public function headings(): array
    {
        return [
            "Дата",
            "Сумма",
            "Назначение",
            "Номер кошелька(Отправитель)",
            "ФИО клиента(Отправитель)",
            "Дата рождения(Отправитель)",
            "Адрес(Отправитель)",
            "Область(Отправитель)",
            "Населенный пункт (город)(Отправитель)",
            "Тип удастоверение(Отправитель)",
            "Удостоверение(Отправитель)",
            "Дата выдачи паспорта(Отправитель)",
            "Гражданство(Отправитель)",
            "Номер кошелька(Получатель)",
            "ФИО клиента(Получатель)",
            "Дата рождения(Получатель)",
            "Адрес(Получатель)",
            "Область(Получатель)",
            "Населенный пункт (город)(Получатель)",
            "Тип удастоверение(Получатель)",
            "Удастоверение(Получатель)",
            "Дата выдачи паспорта(Получатель)",
            "Гражданство(Получатель)",

        ];
    }

}