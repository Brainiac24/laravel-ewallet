<?php

namespace App\Models\DocApi;

use App\Models\BaseModel;

class DocApi extends BaseModel
{
    protected $casts = [
        'response_success_json' => 'array',
        'response_reject_json' => 'array',
        'description' => 'text',
    ];
}
