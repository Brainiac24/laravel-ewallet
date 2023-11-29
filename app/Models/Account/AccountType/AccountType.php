<?php

namespace App\Models\Account\AccountType;

use App\Models\AccountCategoryType\AccountCategoryType;
use App\Models\BaseModel;
use App\Models\Gateway\Gateway;
use App\Services\Common\Filter\Filterable;

/**
 * App\Models\Account\AccountType\AccountType
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $gateway_id
 * @property string $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Gateway\Gateway $gateway
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account\AccountType\AccountType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountType extends BaseModel
{
    use Filterable;
    protected $fillable = [
        'name',
        'code',
        'code_map',
        'parent_id',
        'account_category_type_id',
        'gateway_id',
        'img_uncolored',
        'img_colored',
        'params_json',
        'is_exclude_for_fill',
        'is_show_menu_block_unblock',
        'is_autocheck_balance',
    ];

    protected $casts = [
        'params_json' => 'array',
    ];

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }

    public function account_category_type()
    {
        return $this->belongsTo(AccountCategoryType::class);
    }
}
