<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 01.08.2018
 * Time: 14:05
 */

namespace App\Models\User\UserHistory;

use App\Models\BaseModel;
use App\Models\User\Event\Event;
use App\Models\User\User;

/**
 * App\Models\User\UserHistory\UserHistory
 *
 * @property string $id
 * @property string $user_id
 * @property string $event_id
 * @property array|null $old_params_json
 * @property array|null $new_params_json
 * @property string $entity_type
 * @property string $entity_id
 * @property string $ip
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User\Event\Event $user_events
 * @property-read \App\Models\User\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereNewParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereOldParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserHistory\UserHistory whereUserId($value)
 * @mixin \Eloquent
 */
class UserHistory extends BaseModel
{
    protected $casts = [
        'old_params_json' => 'array',
        'new_params_json' => 'array',
    ];

    public function user_events()
    {
        return $this->belongsTo(Event::class,"event_id");
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
