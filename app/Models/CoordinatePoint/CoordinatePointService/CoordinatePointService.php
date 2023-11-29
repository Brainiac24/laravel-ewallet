<?php


namespace App\Models\CoordinatePoint\CoordinatePointService;


use App\Models\BaseModel;
use App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType;
use App\Services\Common\Filter\Filterable;

class CoordinatePointService extends BaseModel
{
    use Filterable;
    protected $table='coordinate_point_services';
    protected $fillable = [
        'name',
        'position',
        'is_show_for_filter',
        'is_active',
    ];

    public function coordinate_point_type()
    {
        return $this->belongsToMany(CoordinatePointType::class,
            'coordinate_point_type_service',
            'coordinate_point_type_id',
        'coordinate_point_service_id');
    }
}