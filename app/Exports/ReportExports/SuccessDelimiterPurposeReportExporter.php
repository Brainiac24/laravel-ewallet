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

class SuccessDelimiterPurposeReportExporter implements FromArray, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    private $fileName = 'success_delimiter_purpose_report.xlsx';
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
        $res[] = $item['doc_num'];
        $res[] = $item['doc_date'];
        $res[] = $item['amount'];
        $res[] = $item['category'];
        $res[] = $item['service'];
        $res[] = $item['from_account_gateway'];
        $res[] = $item['from_account'] . " ";
        $res[] = $item['to_account_gateway'];
        $res[] = $item['to_account'] . " ";
        $res[] = $item['status'];

        return $res;
    }

    public function headings(): array
    {
        return [
            'DOC_NUM',
            'DOC_DATE',
            'AMOUNT',
            'CATEGORY',
            'SERVICE',
            'FROM_ACCOUNT_GATEWAY',
            'FROM_ACCOUNT',
            'TO_ACCOUNT_GATEWAY',
            'TO_ACCOUNT',
            'STATUS',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
        ];
    }

}