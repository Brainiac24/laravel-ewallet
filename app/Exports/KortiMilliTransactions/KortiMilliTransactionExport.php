<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 11.11.2021
 * Time: 11:26
 */

namespace App\Exports\KortiMilliTransactions;


use Maatwebsite\Excel\Concerns\Exportable;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KortiMilliTransactionExport implements FromCollection, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    protected $transactionRepository;
    protected $data = [];

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'invoices.xlsx';

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
            (string)$item->id,//1
            (string)$item->service->name,//2
//            !isset($item->from_account_without_g_scopes->user)? '' :(string)$item->from_account_without_g_scopes->user->msisdn ,

            ($item->from_account_without_g_scopes != null &&
                $item->from_account_without_g_scopes->account_type!=null &&
                $item->from_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->from_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->from_account_without_g_scopes->user->msisdn} " :
                    "{$item->from_account_without_g_scopes->number} ") : (string)$item->service->name,//3

            $item->from_account_without_g_scopes->account_type->gateway->name ?? $item->service->gateway->name,//4

            ($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type!=null &&
                $item->to_account_without_g_scopes->account_type->account_category_type != null) ?
                ($item->to_account_without_g_scopes->account_type->account_category_type->id==\App\Services\Common\Helpers\AccountCategoryTypes::EWALLET_ID ?
                    "{$item->to_account_without_g_scopes->user->msisdn} " :
                    "{$item->to_account_without_g_scopes->number} ") : (string)$item->service->name,//5

            ($item->to_account_without_g_scopes != null &&
                $item->to_account_without_g_scopes->account_type !=null &&
                $item->to_account_without_g_scopes->account_type->gateway!=null) ?
                (string)$item->to_account_without_g_scopes->account_type->gateway->name
                : (string)$item->service->gateway->name,//6

            (string)$item->params_json_implode,//7
            $item->transaction_status->name,//8
            $item->transaction_status_detail->name,//9
            round($item->amount, 2),//10
            round($item->commission, 2),//11
            $item->currency_iso_name,//12
            !isset($item->user) ? '' : (string)$item->user->msisdn,//13
            !isset($item->user) ? '' : (string)$item->user->full_name_extended_format,//14
            $item->finished_at,//15
            $item->created_at,//16
        ];
    }

    public function headings(): array
    {
        return [
            'id',//A
            'Сервис',//B
            'Плательщик',//C
            'Шлюз',//D
            'Получатель',//E
            'Шлюз',//F
            'Номер/Счет',//J
            'Статус',//H
            'Детальный статус',//I
            'Сумма начисления',//J
            'Коммиссия',//K
            'Валюта',//L
            'Создатель(номер)',//M
            'Создатель(ФИО)',//N
            'Закончен',  //O
            'Создан',  //P
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
            'O' => NumberFormat::FORMAT_DATE_DATETIME,
            'P' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}