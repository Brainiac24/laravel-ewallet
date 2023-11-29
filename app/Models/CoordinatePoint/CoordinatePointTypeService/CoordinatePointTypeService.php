<?php


namespace App\Models\CoordinatePoint\CoordinatePointTypeService;


use App\Models\BaseModel;
use App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType;
use App\Models\CoordinatePoint\CoordinatePointService\CoordinatePointService;
use App\Services\Common\Filter\Filterable;

class CoordinatePointTypeService extends BaseModel
{
    use Filterable;
    protected $table='coordinate_point_type_services';
    protected $fillable = [
        'coordinate_point_type_id',
        'coordinate_point_service_id',
        'is_active',
    ];

    public function coordinate_point_type()
    {
        return $this->belongsTo(CoordinatePointType::class, 'coordinate_point_type_id');
    }

    public function coordinate_point_service()
    {
        return $this->belongsTo(CoordinatePointService::class, 'coordinate_point_service_id');
    }
}