<?php
namespace App\Exports;


interface ExporterCsvContract
{
    public function query();
    public function store($baseFilename);
    public static function getFilename($baseFilename) : string;
    public function map($item): array;
    public function headings(): array;
}