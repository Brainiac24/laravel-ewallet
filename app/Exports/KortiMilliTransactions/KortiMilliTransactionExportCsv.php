<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 11.11.2021
 * Time: 11:26
 */

namespace App\Exports\KortiMilliTransactions;


use App\Exports\BaseExporterCsv;
use App\Models\Transaction\Filters\Backend\TransactionFilter;
use App\Models\Transaction\Transaction;

class KortiMilliTransactionExportCsv extends BaseExporterCsv
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
        return $this->transaction->with('service', 'service.gateway', 'transaction_type', 'user', 'transaction_status_detail', 'transaction_status',
            'from_account_without_g_scopes.user', 'from_account_without_g_scopes.user.attestation', 'from_account_without_g_scopes.account_type.account_category_type',
            'from_account_without_g_scopes.account_type.gateway', 'to_account_without_g_scopes.user', 'to_account_without_g_scopes.user.attestation',
            'to_account_without_g_scopes.account_type.account_category_type', 'to_account_without_g_scopes.account_type.gateway', 'transaction_sync_status')
            ->filterBy(new TransactionFilter($this->data));
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->session_number),
            $item->created_at,
            $item->finished_at,
            $this->stringFormatCsv(!isset($item->user) ? '' : (string)$item->user->full_name_extended_format),
            $this->stringFormatCsv(!isset($item->user) ? '' : (string)$item->user->msisdn),
            $this->numberFormatCsv($item->amount),
            $this->numberFormatCsv($item->commission),
            $this->numberFormatCsv($item->amount + $item->commission),
            $item->currency_iso_name,
            $this->stringFormatCsv($item->transaction_status->name),
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
            $this->stringFormatCsv($item->transaction_status_detail->name),
            (string)$item->id,
        ];
    }

    public function headings(): array
    {
        return [
            'Сессия (Номер проводки АБС)',

            'Создан',  //Xэ
            'Закончен',  //W
            'Создатель(ФИО)',
            'Создатель(номер)',
            'Сумма',
            'Комиссия',
            'Сумма + Комиссия',
            'Валюта',
            'Статус',
            'Сервис',
            'Плательщик',
            'Шлюз счёта плательщика (Списание)',
            'Получатель',
            'Шлюз счёта получателя (Пополнение)',
            'Детальный статус',
            'id',
        ];
    }
}