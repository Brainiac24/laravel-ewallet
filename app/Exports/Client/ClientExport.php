<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 12.10.2018
 * Time: 11:54
 */

namespace App\Exports\Client;

use App\Repositories\Backend\User\Client\ClientRepositoryContract;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClientExport implements FromCollection, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting, WithBatchInserts
{

    use Exportable;

    protected $clientRepository;
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
        $this->clientRepository = \App::make(ClientRepositoryContract::class);
        $this->data = $data;
    }

    public function collection()
    {
        return $this->clientRepository->all($this->data);
    }

    /**
     * @param $client
     * @return array
     */
    public function map($client): array
    {
        return [
            (string) $client->msisdn,
            $client->first_name,
            $client->last_name,
            $client->middle_name,
            $client->accounts[0]->balance ?? null,
            $client->accounts[0]->currency->iso_name ?? null,
            $client->attestation->name,
            $client->is_active === false ? 'Неактивный' : 'Активный',
            $client->is_auth === false ? 'Неавторизован' : 'Авторизован',
            $client->blocked_at, //H
            $client->last_login_at,  //I
            $client->document_type->name ?? '',
            $client->country->name ?? '',
            $client->region->name ?? '',
            $client->area->name ?? '',
            $client->city->name ?? '',
            $client->country_born->name ?? '',
            trans('constantsInterface.gender.' . $client->gender),
            $client->is_editable === false ? 'Запрещено' : 'Разрещено',
            $client->email,
            $client->created_at, //N
            empty($client->updated_at) ? null : Date::dateTimeToExcel($client->updated_at), //O
            json_encode($client->contacts_json),

        ];
    }

    public function headings(): array
    {
        return [
            'MSISDN',
            'Имя',
            'Фамилия',
            'Отчество',
            'Баланс',
            'Валюта',
            'Аттестация',
            'Статус',
            'Авторизирован',
            'Блокирован',
            'Последний вход',
            'Тип документа',
            'Гражданство',
            'Регион',
            'Район',
            'Город',
            'Место рождения',
            'Пол',
            'Редактирование',
            'Email',
            'Дата создания',
            'Дата изменения',
            'Контакты',

        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DATETIME,
            'J' => NumberFormat::FORMAT_DATE_DATETIME,
            'M' => NumberFormat::FORMAT_DATE_DATETIME,
            'N' => NumberFormat::FORMAT_DATE_DATETIME,
            'O' => NumberFormat::FORMAT_DATE_DATETIME,
            'P' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function batchSize(): int
    {
        return 200;
    }

}
