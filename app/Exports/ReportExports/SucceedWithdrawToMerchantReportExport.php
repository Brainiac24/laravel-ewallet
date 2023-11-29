<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 12.10.2018
 * Time: 11:54
 */

namespace App\Exports\ReportExports;


use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SucceedWithdrawToMerchantReportExport implements FromArray, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    private $fileName = 'success.xlsx';
    private $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function map($item): array
    {
        $res = [];
        $res[] = Date::dateTimeToExcel(Carbon::now());
        $res[] = $item['status'];
        $res[] = (string) $item['merchant']->name;
        $res[] = "";
        $res[] = "";
        $res[] = "";
        $res[] = $item['amount']??"";
        $res[] = $item['desc'];

        return $res;
    }

    public function headings(): array
    {
        return [
            'REPORT_DATE',
            'STATUS',
            'MERCHANT_NAME',
            'TRANSACTION_CREATED_DATE',
            'TRANSACTION_ID',
            'TRANSACTION_SESSION_NUMBER',
            'TRANSACTION_AMOUNT',
            'COMMENT',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DATETIME,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

}