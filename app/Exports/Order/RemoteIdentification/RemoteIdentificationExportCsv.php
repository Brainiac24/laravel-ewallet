<?php
namespace App\Exports\Order\RemoteIdentification;

use App\Models\Order\Order;
use App\Exports\BaseExporterCsv;
use App\Models\Order\Filters\OrderFilter;


class RemoteIdentificationExportCsv extends BaseExporterCsv
{
    protected $order;
    protected $data = [];

    /**
     * RemoteIdentificationExportCsv constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->order = new Order();
        $this->data = $data;
    }

    public function query()
    {
        return $this->order->select("*")
            ->with('order_status','order_process_status', 'processed_by_user')
            ->isRemoteIdentification()
            ->filterBy(new OrderFilter($this->data))->orderBy('created_at', 'desc');
    }

    /**
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        $calls=[];
        $comment='';
        if (isset($item->remote_identification_payload_params["history"]["calls"])){
            $calls=$item->remote_identification_payload_params["history"]["calls"];
        }
        if (isset($item->remote_identification_payload_params["history"]["comment"])){
            $comment=$item->remote_identification_payload_params["history"]["comment"];
        }
        return [
            $item->created_at,
            $item->updated_at,
            $this->stringFormatCsv($item->remote_identification_payload_params["profile"]["Items"]["full_name"]??null),
            $this->stringFormatCsv($item->from_user->msisdn),
            $this->stringFormatCsv(($item->remote_identification_payload_params["profile"]["Items"]["passport_seria"] ?? '').
                ($item->remote_identification_payload_params["profile"]["Items"]["passport_number"]?? '')),
            $this->stringFormatCsv($item->remote_identification_payload_params["profile"]["Items"]["address"]??''),
            $this->stringFormatCsv($item->remote_identification_payload_params["profile"]["Items"]["inn"] ?? ''),
            $this->stringFormatCsv($item->order_status->name),
            $this->stringFormatCsv($item->order_process_status->name??null),
            $this->stringFormatCsv($item->information??null),
            $this->stringFormatCsv($item->from_user->attestation->name??null),
            $this->stringFormatCsv($comment),
            $this->stringFormatCsv( json_encode($calls)),
            $this->stringFormatCsv( $item->processed_by_user->full_name_extended_format??null),
            $this->stringFormatCsv( $item->number??null),
        ];
    }

    public function headings(): array
    {
        return [
            trans('remoteIdentification.backend.table.created_at'),
            trans('remoteIdentification.backend.table.updated_at'),
            trans('remoteIdentification.backend.table.user_full_name'),
            trans('remoteIdentification.backend.table.msisdn'),
            trans('remoteIdentification.backend.table.passport'),
            trans('remoteIdentification.backend.table.address'),
            trans('remoteIdentification.backend.table.inn'),
            trans('remoteIdentification.backend.table.status'),
            trans('remoteIdentification.backend.table.process_status'),
            trans('remoteIdentification.backend.table.information'),
            trans('users.backend.table.attestation_id'),
            trans('remoteIdentification.backend.comment'),
            trans('remoteIdentification.backend.call_comment'),
            'Обработал',
            trans('remoteIdentification.backend.number'),
        ];
    }

}