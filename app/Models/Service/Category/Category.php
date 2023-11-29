<?php

namespace App\Models\Service\Category;

use App\Models\BaseModel;
use App\Models\Service\Service;

/**
 * App\Models\Service\Category\Category
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $parent_id
 * @property int $is_active
 * @property int $position
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service\Service[] $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category root()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $icon_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereIconUrl($value)
 * @property int $is_enabled
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service\Category\Category whereIsEnabled($value)
 */
class Category extends BaseModel
{

    protected $casts = [
        'is_enabled' => 'integer',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)->
            withPivot('category_id', 'service_id', 'position')
            ->orderBy('pivot_position', 'asc');
    }

    public function scopeRoot($q)
    {
        return $q->where('parent_id', '0');
    }

    protected $fillable = [
        'code',
        'name',
        'category_type_id',
        'parent_id',
        'is_active',
        'is_enabled',
        'position',
        'icon_url',
        'is_searchable',
    ];

}
