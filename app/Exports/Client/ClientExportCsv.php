<?php
namespace App\Exports\Client;


use App\Models\User\User;
use App\Exports\BaseExporterCsv;
use App\Models\User\Filters\ClientFilter;
use App\Models\Account\Scopes\OwnUserIdScope;

class ClientExportCsv extends BaseExporterCsv
{
    protected $client;
    protected $data = [];

    public function __construct($data = [])
    {
        $this->client = new User();
        $this->data = $data;
    }

    public function query()
    {
        return $this->client->with(['accounts' => function ($q) {
            $q->with('currency')->where('account_type_id', config('app_settings.default_wallet_account_type_id'))->withoutGlobalScope(OwnUserIdScope::class);
        }])
            ->orderBy('created_at', 'desc')
            ->isClient()
            ->with('attestation','document_type','country','region','area','city','country_born')
            ->filterBy(new ClientFilter($this->data));
    }

    /**
     * @param $client
     * @return array
     */
    public function map($client): array
    {
        return [
            $this->stringFormatCsv($client->msisdn),
            $this->stringFormatCsv($client->code_map),
            $this->stringFormatCsv($client->first_name),
            $this->stringFormatCsv($client->last_name),
            $this->stringFormatCsv($client->middle_name),
            $this->numberFormatCsv($client->accounts[0]->balance ?? null),
            $client->accounts[0]->currency->iso_name ?? null,
            $client->attestation->name,
            $this->stringFormatCsv($client->verification_params_json['verify_date'] ?? ''),
            $this->stringFormatCsv($client->verification_params_json['verify_by_system'] ?? ''),
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
            $client->updated_at, //O
            json_encode($client->contacts_json),

        ];
    }

    public function headings(): array
    {
        return [
            'MSISDN',
            'АБС код',
            'Имя',
            'Фамилия',
            'Отчество',
            'Баланс',
            'Валюта',
            'Аттестация',
            'Дата идентификации',
            'Идентифицирован',
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
}
