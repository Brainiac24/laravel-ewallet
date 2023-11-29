<?php

namespace App\Models\TransferList;

use App\Models\BaseModel;

class TransferList extends BaseModel
{
    //
    protected $table = 'transfer_lists';
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'icon_url',
        'desc',
        'is_active',
    ];
}
