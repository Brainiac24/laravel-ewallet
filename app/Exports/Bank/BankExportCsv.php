<?php

namespace App\Exports\Bank;

use App\Exports\BaseExporterCsv;
use App\Models\Bank\Bank;
use App\Models\Bank\Filters\BankFilter;
use Maatwebsite\Excel\Concerns\FromCollection;

class BankExportCsv extends BaseExporterCsv
{

    protected $bank;
    protected $data = [];

    /**
     * MerchantExportCsv constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->bank = new Bank();
        $this->data = $data;
    }

    public function query()
    {
        return $this->bank
            ->select("*")
            ->filterBy(new BankFilter($this->data))
            ->orderBy('created_at', 'desc');
    }

    public function map($item): array
    {
        return [
            $this->stringFormatCsv($item->id),
            $this->stringFormatCsv($item->code),
            $this->stringFormatCsv($item->code_map),
            $this->stringFormatCsv($item->name),
            $this->stringFormatCsv($item->description),
            $this->stringFormatCsv($item->bic),
            $this->stringFormatCsv($item->corr_acc),
            $this->stringFormatCsv($item->position),
            $this->stringFormatCsv(trans("InterfaceTranses.is_active")[$item->is_active] ?? null),
            $item->created_at,
            $item->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            "ID",
            "Код",
            "Код банка",
            "Название",
            "Полное название",
            "BIC",
            "Корр. счет",
            "Позиция",
            "Статус",
            "Дата создания",
            "Дата редактирования",
        ];
    }

}
