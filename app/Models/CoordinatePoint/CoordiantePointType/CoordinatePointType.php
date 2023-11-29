<?php


namespace App\Models\CoordinatePoint\CoordiantePointType;


use App\Models\BaseModel;
use App\Models\CoordinatePoint\CoordinatePointCity\CoordinatePointCity;
use App\Models\CoordinatePoint\CoordinatePointService\CoordinatePointService;
use App\Models\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkday;
use App\Services\Common\Filter\Filterable;

class CoordinatePointType extends BaseModel
{
    use Filterable;
    protected $table='coordinate_point_types';
    protected $fillable = [
        'name',
        'position',
        'coordinate_point_workday_id',
        'is_active',
        'code',
        'is_show_for_filter',
    ];

    public function coordinate_point_workday()
    {
        return $this->belongsTo(CoordinatePointWorkday::class, 'coordinate_point_workday_id')->withDefault();
    }

    public function coordinate_point_services()
    {
        return $this->belongsToMany(CoordinatePointService::class,
            'coordinate_point_type_service',
            'coordinate_point_service_id',
            'coordinate_point_type_id');
    }
}