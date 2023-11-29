<?php
namespace App\Exports;

use File;

abstract class BaseExporterCsv implements ExporterCsvContract
{
    private static $path = 'export_csv';

    /*public function store1($baseFilename)
    {
        $data = $this->collection();

        $fp = fopen(self::getFilename($baseFilename), 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        fputcsv($fp, $this->headings(),";");

        foreach ($data as $dt) {
            fputcsv($fp, $this->map($dt),";");
        }

        fclose($fp);
    }*/

    public function store($baseFilename)
    {
        $reportsSelectLimit = config('app_settings.reports_select_limit');
        $fp = fopen(self::getFilename($baseFilename), 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
        fputcsv($fp, $this->headings(),";");
        $this->query()->each(function($dt) use($fp)
        {
            fputcsv($fp, $this->map($dt),";");
        }, $reportsSelectLimit);

        fclose($fp);
    }

    public static function getFilename($baseFilename) : string
    {
        $path = storage_path(self::$path);
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        return $path."/".$baseFilename;
    }

    protected function stringFormatCsv($input)
    {
        if(preg_match("/[0-9]/i", $input)) {
            $input = str_replace('"',"'",$input);
            return '= "' . $input . '"';
        }

        return $input;
    }

    protected function numberFormatCsv($input)
    {
        return number_format($input,4,",","");
    }
}