<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 12.10.2018
 * Time: 11:54
 */

namespace App\Exports\Transactions;


use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Helpers\Service;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionExport implements FromCollection, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    protected $transactionRepository;
    protected $data = [];

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'invoices.xlsx';

    /**
     * ClientExport constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->transactionRepository = \App::make(TransactionRepositoryContract::class);
        $this->data = $data;
    }

    public function collection()
    {
        return $this->transactionRepository->all($this->data);
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            (string)$item->id,
            (string)$item->service->name,
//            !isset($item->from_account_without_g_scopes->user)? '' :(string)$item->from_account_without_g_scopes->user->msisdn ,

            ($item->from_account_without_g_scopes != null &&
                $item->from_account_without_g_scopes->account_type!=null &&
                $item->from_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->from_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->from_account_without_g_scopes->user->msisdn} " :
                    "{$item->from_account_without_g_scopes->number} ") : (string)$item->service->name,

            $item->from_account_without_g_scopes->account_type->gateway->name ?? $item->service->gateway->name,

            ($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type!=null &&
                $item->to_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->to_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->to_account_without_g_scopes->user->msisdn} " :
                    "{$item->to_account_without_g_scopes->number} ") : (string)$item->service->name,

            ($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type !=null &&
                $item->to_account_without_g_scopes->account_type->gateway!=null) ?
                (string)$item->to_account_without_g_scopes->account_type->gateway->name
                : (string)$item->service->gateway->name,

            (string)$item->params_json_implode,
            $item->to_merchant_item_name_text,
            $item->transaction_status->name,
            $item->transaction_status_detail->name,
            round($item->amount, 2),
            round($item->converted_amount, 2),
            round($item->commission, 2),
            $item->session_number,
            !isset($item->user) ? '' : (string)$item->user->msisdn,
            !isset($item->user) ? '' : (string)$item->user->full_name_extended_format,
            $item->try_count,
            $item->flag,
            $item->comment,
            $item->currency_rate_value,
            $item->currency_iso_name,
            $item->from_currency_iso_name,
            $item->to_currency_iso_name,
            $item->account_balance,
            $item->sms_code_sent_at,
            $item->add_to_favorite,
            $item->is_queued,
            $item->session_in,
            (string)json_encode($item->device_platform),
            $item->next_try_at,
            $item->finished_at,
            $item->created_at,
            !empty($item->from_account_without_g_scopes) ? $item->from_account_without_g_scopes->user->attestation->name : "",
            !empty($item->to_account_without_g_scopes) ? $item->to_account_without_g_scopes->user->attestation->name : "",
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
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'Q' => NumberFormat::FORMAT_DATE_DATETIME,
            'V' => NumberFormat::FORMAT_DATE_DATETIME,
            'W' => NumberFormat::FORMAT_DATE_DATETIME,
            'X' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

}