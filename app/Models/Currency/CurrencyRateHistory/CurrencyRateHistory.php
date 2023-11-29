<?php

namespace App\Models\Currency\CurrencyRateHistory;

use App\Models\BaseModel;
use App\Models\Currency\Currency;
use App\Services\Common\Traits\UuidModel;


/**
 * App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory
 *
 * @property string $id
 * @property float $value_buy
 * @property float $value_sell
 * @property string $currency_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereValueBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\CurrencyRateHistory\CurrencyRateHistory whereValueSell($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Currency\Currency $currency
 */
class CurrencyRateHistory extends BaseModel
{
    use UuidModel;

    public $incrementing = false;

    protected $fillable = [
        'value_buy',
        'value_sell',
        'currency_id',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
