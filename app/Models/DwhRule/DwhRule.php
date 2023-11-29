<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 16:58
 */

namespace App\Models\DwhRule;


use App\Models\BaseModel;
use App\Services\Common\Filter\Filterable;

class DwhRule extends BaseModel
{
    use Filterable;

    protected $guarded = [];
    public $timestamps = false;
}