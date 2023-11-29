<?php


namespace App\Models\Schedule\ScheduleType;


use App\Models\BaseModel;

class ScheduleType extends BaseModel
{
    protected $fillable = [
        'name',
        'fields',
        'type',
        'value',
        'is_active'
    ];

    protected $casts = [
        'fields' => 'array',
    ];
}