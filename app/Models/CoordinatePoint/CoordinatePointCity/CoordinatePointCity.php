<?php


namespace App\Models\CoordinatePoint\CoordinatePointCity;


use App\Models\BaseModel;
use App\Models\City\City;

class CoordinatePointCity extends BaseModel
{
    protected $fillable = [
        'city_id',
        'version',
        'is_active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault();
    }
}