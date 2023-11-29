<?php


namespace App\Models\Schedule\ScheduleJob;


use App\Models\BaseModel;

class ScheduleJob extends BaseModel
{

    protected $casts = [
        'payload' => 'array',
        'available_at' => 'datetime'
    ];

    public function getDisplayNameAttribute()
    {
        return $this->payload['displayName']??'';
    }
}