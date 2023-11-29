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

class FailedDelimiterPurposeReportExporter implements FromArray, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    private $fileName = 'delimiter_purpose_report.xlsx';
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
        $res[] = $item['transaction_id'];
        $res[] = $item['doc_num'];
        $res[] = $item['error_message'];
        $res[] = $item['error_trace'];

        return $res;
    }

    public function headings(): array
    {
        return [
            'TRANSACTION_ID',
            'DOC_NUM',
            'ERROR_MESSAGE',
            'ERROR_TRACE',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }

}