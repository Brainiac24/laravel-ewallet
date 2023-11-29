<?php

namespace App\Models\Service\Workday;

use App\Models\BaseModel;



/**
 * App\Models\Service\Workday\Workday
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $monday
 * @property string|null $tuesday
 * @property string|null $wednesday
 * @property string|null $thursday
 * @property string|null $friday
 * @property string|null $saturday
 * @property string|null $sunday
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereFriday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereMonday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereSaturday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereSunday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereThursday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereTuesday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Workday\Workday whereWednesday($value)
 * @mixin \Eloquent
 */
class Workday extends BaseModel
{
    
    protected $fillable = [
        'name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];
}
