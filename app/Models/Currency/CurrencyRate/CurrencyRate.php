<?php

namespace App\Models\Currency\CurrencyRate;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyRateCategory\CurrencyRateCategory;
use App\Services\Common\Filter\Filterable;


/**
 * App\Models\Currency\CurrencyRate\CurrencyRate
 *
 * @property string $id
 * @property float $value_buy
 * @property float $value_sell
 * @property string $currency_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Currency\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereValueBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate whereValueSell($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRate\CurrencyRate filterBy(\App\Services\Common\Filter\QueryFilter $queryFilter)
 */
class CurrencyRate extends BaseModel
{
    use Filterable;
    protected $fillable = [
        'value_buy', 'value_sell', 'currency_id', 'currency_rate_category_id'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function currency_rate_category()
    {
        return $this->belongsTo(CurrencyRateCategory::class);
    }


}
