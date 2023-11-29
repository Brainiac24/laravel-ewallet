<?php
namespace App\Reports;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

interface ReporterContract
{
    public function applyIndex();

    public function indexView(array $data) : View;

    public function searchFiledsView() : View;

    public function exportToCsv(array $data) : void;

    public function getRequest() : FormRequest;
}