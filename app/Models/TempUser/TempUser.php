<?php

namespace App\Models\TempUser;

use App\Models\Area\Area;
use App\Models\BaseModel;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\DocumentType\DocumentType;
use App\Models\Region\Region;
use App\Services\Common\Filter\Filterable;

class TempUser extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'middle_name',
        'contacts_json',
        'msisdn',
        'code_map',
        'country_id',
        'country_born_id',
        'region_id',
        'area_id',
        'city_id',
        'document_type_id',
    ];

    protected $casts = [
        'contacts_json' => 'array',
    ];

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function country_born()
    {
        return $this->belongsTo(Country::class, 'country_born_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
