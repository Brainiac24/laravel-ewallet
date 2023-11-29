<?php

namespace App\Models\User\Event;

use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

/**
 * App\Models\User\Event\Event
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Event\Event whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Event\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Event\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Event\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Event\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'code',
        'name',
    ];
}
