<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 16.12.2019
 * Time: 13:33
 */

namespace App\Models\Merchant\MerchantCategory;


use App\Models\BaseModel;
use App\Models\Merchant\Merchant;
use App\Services\Common\Filter\Filterable;

class MerchantCategory extends BaseModel
{
    use Filterable;

    protected $fillable = [
        //'id',
        'name',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function merchant()
    {
        return $this->belongsToMany(Merchant::class)->
        withPivot('merchant_category_id', 'merchant_id')
            ->orderBy('id');
    }
}