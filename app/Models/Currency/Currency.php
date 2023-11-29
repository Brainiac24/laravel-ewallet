<?php

namespace App\Models\Currency;

use App\Models\BaseModel;


/**
 * App\Models\Currency\Currency
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $short_name
 * @property string $iso_name
 * @property string|null $symbol_left
 * @property string|null $symbol_right
 * @property int $is_primary
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereIsoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereSymbolLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereSymbolRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends BaseModel
{

    protected $fillable = [
        'code',
        'code_map',
        'name',
        'short_name',
        'iso_name',
        'symbol_left',
        'symbol_right',
        'is_primary',
        'icon',
        'is_active',
    ];


}
