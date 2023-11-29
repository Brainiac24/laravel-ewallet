<?php


namespace App\Models\ReportAnalysis;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class ReporAnalysis extends BaseModel
{
    use Filterable;

    protected $table='report_analyzes';

    protected $fillable = [
        'name',
        'params_json',
        'is_active',
    ];

    protected $casts = [
        'params_json' => 'array',
    ];
}