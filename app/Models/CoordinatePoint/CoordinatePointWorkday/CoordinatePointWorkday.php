<?php


namespace App\Models\CoordinatePoint\CoordinatePointWorkday;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class CoordinatePointWorkday extends BaseModel
{
    use Filterable;
    protected $table='coordinate_point_workdays';
    protected $fillable = [
        'name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'is_active',
    ];
}