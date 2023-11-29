<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 10:11
 */

namespace App\Models\News;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class News extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'tags',
        'image_name',
        'is_push_notification',
        'is_active',
        'position'
    ];
}