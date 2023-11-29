<?php


namespace App\Models\Schedule;


use App\Models\BaseModel;
use App\Models\Schedule\ScheduleType\ScheduleType;
use App\Models\User\User;

class Schedule extends BaseModel
{
    protected $fillable = [
        'name',
        'cron_expression',
        'create_by_user_id',
        'schedule_type_id',
        'is_active',
    ];

    public function scheduleType()
    {
        return $this->belongsTo(ScheduleType::class, 'schedule_type_id')->withDefault();
    }

    public function createByUser()
    {
        return $this->belongsTo(User::class, 'create_by_user_id')->withDefault();
    }

}