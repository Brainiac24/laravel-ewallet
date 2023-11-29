<?php

namespace App\Models\Service;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyRateCategory\CurrencyRateCategory;
use App\Models\Gateway\Gateway;
use App\Models\Service\Category\Category;
use App\Models\Service\Commission\Commission;
use App\Models\Service\ServiceLimit\ServiceLimit;
use App\Models\Service\ServiceOtpLimit\ServiceOtpLimit;
use App\Models\Service\Workday\Workday;
use App\Services\Common\Filter\Filterable;


/**
 * App\Models\Service\Service
 *
 * @property string $id
 * @property string $code
 * @property string $processing_code
 * @property string $name
 * @property string|null $icon_url
 * @property array|null $params_json
 * @property float $min_amount
 * @property float $max_amount
 * @property int $is_active
 * @property int $is_enabled
 * @property string|null $requestable_balance_params
 * @property int $is_from_accountable
 * @property int $is_to_accountable
 * @property int $position
 * @property string|null $service_limit_id
 * @property string $gateway_id
 * @property string|null $workday_id
 * @property string|null $commission_id
 * @property string|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service\Category\Category[] $categories
 * @property-read \App\Models\Service\Commission\Commission|null $commission
 * @property-read \App\Models\Currency\Currency|null $currency
 * @property-read \App\Models\Gateway\Gateway $gateway
 * @property-read mixed $params_text
 * @property-read \App\Models\Service\ServiceLimit\ServiceLimit|null $service_limit
 * @property-read \App\Models\Service\Workday\Workday|null $workday
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereCommissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereIconUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereIsFromAccountable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereIsToAccountable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereMaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereMinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereParamsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereProcessingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereRequestableBalanceParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereServiceLimitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Service whereWorkdayId($value)
 * @mixin \Eloquent
 */
class Service extends BaseModel
{
    use Filterable;


    protected $fillable = [
        'id',
        'name',
        'code_map',
        'code',
        'processing_code',
        'icon_url',
        'in_icon_url',
        'out_icon_url',
        'params_json',
        'min_amount',
        'max_amount',
        'is_active',
        'is_enabled',
        'requestable_balance_params',
        'is_to_accountable',
        'position',
        'service_limit_id',
        'service_otp_limit_id',
        'gateway_id',
        'workday_id',
        'commission_id',
        'currency_id',
        'currency_rate_category_id',
        'add_to_favorite',
        'extend_params_json',
        'is_checkable',
    ];
    protected $casts = [
        'params_json' => 'array',
        'extend_params_json' => 'array',
        'min_amount' => 'float',
        'max_amount' => 'float',
        'is_enabled' => 'integer',
    ];

    public function getParamsTextAttribute()
    {
        return \json_encode($this->params_json);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id','service_id','position');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }

    public function service_limit()
    {
        return $this->belongsTo(ServiceLimit::class);
    }

    public function service_otp_limit()
    {
        return $this->belongsTo(ServiceOtpLimit::class);
    }

    public function workday()
    {
        return $this->belongsTo(Workday::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function currency_rate_category()
    {
        return $this->belongsTo(CurrencyRateCategory::class);
    }
}
