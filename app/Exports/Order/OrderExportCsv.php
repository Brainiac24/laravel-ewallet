<?php


namespace App\Exports\Order;


use App\Exports\BaseExporterCsv;
use App\Models\Order\Filters\OrderFilter;
use App\Models\Order\Order;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;

class OrderExportCsv extends BaseExporterCsv
{

    protected $order;
    protected $data = [];
    protected $accountTypeRepository;

    public function __construct($data = [])
    {
        $this->order = new Order();
        $this->accountTypeRepository = app()->make(AccountTypeRepositoryContract::class);
        $this->data = $data;
    }

    public function query()
    {
        return $this->order
            ->with('from_user', 'to_user', 'order_type', 'order_status','order_process_status')
            ->filterBy(new OrderFilter($this->data))->orderBy('created_at', 'desc');
    }

    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->id),
            $this->stringFormatCsv($item->order_type->name),
            $this->numberFormatCsv($item->number),
            $this->stringFormatCsv($item->from_user->fullNameExtendedFormat ?? '' ),
            $this->stringFormatCsv($item->from_user->username ?? ""),
            $this->stringFormatCsv($item->to_user->username ?? ""),
            $this->stringFormatCsv($item->entity_type),
            $this->stringFormatCsv($item->entity_id),
            $this->stringFormatCsv($item->order_status->name ?? ""),
            $this->stringFormatCsv($item->order_process_status->name ?? ""),
            $item->updated_at,
            $item->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            trans('order.backend.table.order_type'),
            trans('order.backend.table.number'),
            trans('order.backend.table.from_user_fio'),
            trans('order.backend.table.from_user'),
            trans('order.backend.table.to_user'),
            trans('order.backend.table.entity'),
            trans('order.backend.table.entity_id'),
            trans('order.backend.table.order_status'),
            trans('order.backend.table.order_process_status_id'),
            trans('order.backend.table.updated_at'),
            trans('order.backend.table.created_at'),
        ];
    }

}