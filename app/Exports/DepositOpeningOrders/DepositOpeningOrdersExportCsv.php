<?php

namespace App\Exports\DepositOpeningOrders;

use App\Exports\BaseExporterCsv;
use App\Models\Order\Filters\OrderFilter;
use App\Models\Order\Order;
use App\Services\Common\Helpers\OrderType;

class DepositOpeningOrdersExportCsv extends BaseExporterCsv
{

    protected $order;
    protected $data = [];

    /**
     * MerchantExportCsv constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->order = new Order();
        $this->data = $data;
    }

    public function query()
    {
        return
            $this->order::with('from_user', 'to_user', 'order_type', 'order_status', 'order_process_status')
                ->where('order_type_id', OrderType::DEPOSIT_TYPE_ITEM_CREATE)
                ->filterBy(new OrderFilter($this->data))->orderBy('created_at', 'desc');
    }

    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->id),
            $this->stringFormatCsv($item->order_type->name),
            $this->stringFormatCsv($item->number),
            $this->stringFormatCsv($item->from_user->username ?? ""),
            $this->stringFormatCsv($item->from_user->fullNameExtendedFormat ?? ""),
            $this->stringFormatCsv($this->getPayloadParam($item->payload_params_json, 'account_number')),
            $this->stringFormatCsv($item->entity_type),
            $this->stringFormatCsv($item->order_status->name ?? ''),
            $this->stringFormatCsv($item->order_process_status->name ?? ""),
            $item->created_at,
            $item->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            "ID",
            "Тип",
            "Номер",
            "От",
            "От ФИО",
            "Номер счета",
            "Сущность",
            "Статус",
            'Статус процесса',
            "Дата создания",
            "Дата редактирования",
        ];
    }

    private function getPayloadParam($payload, $param)
    {
        return $payload[$param] ?? '';
    }

}
