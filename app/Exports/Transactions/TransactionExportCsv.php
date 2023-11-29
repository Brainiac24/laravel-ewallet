<?php
namespace App\Exports\Transactions;

use App\Exports\BaseExporterCsv;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;


class TransactionExportCsv extends BaseExporterCsv
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
        return $this->transaction->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status', 'from_account_without_g_scopes.user', 'from_account_without_g_scopes.user.attestation', 'from_account_without_g_scopes.account_type.account_category_type', 'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.user.attestation', 'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status', 'merchant_item')->filterBy(new TransactionFilter($this->data));
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            (string)$item->id,
            $this->stringFormatCsv($item->service->name),
            $this->stringFormatCsv(($item->from_account_without_g_scopes != null &&
                $item->from_account_without_g_scopes->account_type!=null &&
                $item->from_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->from_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->from_account_without_g_scopes->user->msisdn} " :
                    "{$item->from_account_without_g_scopes->number} ") : (string)$item->service->name),

            $this->stringFormatCsv($item->from_account_without_g_scopes->account_type->gateway->name ?? $item->service->gateway->name),

            $this->stringFormatCsv(($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type!=null &&
                $item->to_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->to_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->to_account_without_g_scopes->user->msisdn} " :
                    "{$item->to_account_without_g_scopes->number} ") : (string)$item->service->name),

            $this->stringFormatCsv(($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type !=null &&
                $item->to_account_without_g_scopes->account_type->gateway!=null) ?
                (string)$item->to_account_without_g_scopes->account_type->gateway->name
                : (string)$item->service->gateway->name),

            (string)$item->params_json_implode,
            $this->stringFormatCsv($item->to_merchant_item_name_text),
            $this->stringFormatCsv($item->transaction_status->name),
            $this->stringFormatCsv($item->transaction_status_detail->name),
            $this->numberFormatCsv($item->amount),
            $this->numberFormatCsv($item->converted_amount),
            $this->numberFormatCsv($item->commission),
            $this->stringFormatCsv($item->session_number),
            $this->stringFormatCsv(!isset($item->user) ? '' : (string)$item->user->msisdn),
            $this->stringFormatCsv(!isset($item->user) ? '' : (string)$item->user->full_name_extended_format),
            $item->try_count,
            $item->flag,
            $this->stringFormatCsv($item->comment),
            $this->numberFormatCsv($item->currency_rate_value),
            $item->currency_iso_name,
            $item->from_currency_iso_name,
            $item->to_currency_iso_name,
            $this->numberFormatCsv($item->account_balance),
            $item->sms_code_sent_at,
            $item->add_to_favorite,
            $item->is_queued,
            $this->stringFormatCsv($item->session_in),
            (string)json_encode($item->device_platform),
            $item->next_try_at,
            $item->finished_at,
            $item->created_at,
            !empty($item->from_account_without_g_scopes) ? $item->from_account_without_g_scopes->user->attestation->name : "",
            !empty($item->to_account_without_g_scopes) ? $item->to_account_without_g_scopes->user->attestation->name : "",
            isset($item->user) &&
                isset($item->user->verification_params_json["is_previously_identified"]) &&
                $item->user->verification_params_json["is_previously_identified"] == true ? "Да" : "Нет"
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Сервис',
            'Плательщик',
            'Шлюз',
            'Получатель',
            'Шлюз',
            'Номер/Счет',
            'Касса',
            'Статус',
            'Детальный статус',
            'Сумма начисления',
            'Сумма начисления(конвертированная)',
            'Коммиссия',
            'Номер сессии',
            'Создатель(номер)',
            'Создатель(ФИО)',
            'Кол. Попыток',
            'Доп. Флаги',
            'Комментарий',
            'Курс',
            'Валюта',
            'Валюта (продажи)',
            'Валюта (покупки)',
            'Баланс',
            'Время отправки SMS',  //Q
            'Добавлять в избранное',
            'Отправлено в очередь',
            'Информация шлюза',
            'Устройство',
            'След. Попытка',  //V
            'Закончен',  //W
            'Создан',  //X
            'Статус Плательщика',
            'Статус Получателя',  //X
            'Ранее идентифицированный',
        ];
    }

}