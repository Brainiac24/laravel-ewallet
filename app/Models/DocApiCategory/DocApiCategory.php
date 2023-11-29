<?php

namespace App\Models\DocApiCategory;

use App\Models\BaseModel;
use App\Models\DocApi\DocApi;

class DocApiCategory extends BaseModel
{
    public function apis()
    {
        return $this->hasMany(DocApi::class);
    }
}
