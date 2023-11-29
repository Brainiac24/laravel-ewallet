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
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ReportExport implements FromCollection, WithStrictNullComparison, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'invoices.xlsx';

    /**
     * ClientExport constructor.
     * @param array $data
     */
    public function __construct()
    {

    }

    public function collection()
    {
        return \DB::table('users')
            ->join('accounts', function ($join) {
                $join->on('users.id', '=', 'accounts.user_id');
            })->where('accounts.account_type_id', '=', '05864267-a077-11e8-904b-b06ebfbfa715')//account type ewallet
            ->where(function ($query) {
                $query->where('accounts.balance', '!=', 0)
                    ->orWhere('accounts.blocked_balance', '!=', 0);
            })
            ->get();
    }

    /**
     * @param $client
     * @return array
     */
    public function map($item): array
    {
        return [
            Date::dateTimeToExcel(Carbon::now()), //A
            (string)$item->msisdn,
            $item->balance,
            $item->blocked_balance,
            $item->number,

        ];
    }

    public function headings(): array
    {
        return [
            'REPOTDATE',
            'MSISDN',
            'BALANCE',
            'BLOCKED_BALANCE',
            'NUMBER',
            'CREATED_AT',
            'UPDATED_AT',

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
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
            'G' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

}