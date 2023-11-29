<?php

namespace App\Models\Order\OrderDepositType;

use App\Models\BaseModel;
use App\Models\Service\Service;
use App\Services\Common\Filter\Filterable;


class OrderDepositType extends BaseModel
{
    use Filterable;
    //
    protected $fillable = [
        'id',
        'code',
        'code_map',
        'name',
        'icon',
        'service_id',
        'position',
        'contract_html',
        'detail_params_html',
        'is_active',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
