<?php

namespace App\Models\User\Role;

use App\Services\Common\Traits\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;


/**
 * App\Models\User\Role\Role
 *
 * @property string $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Permission\Permission[] $permissions
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\Role\Role onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Role\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\Role\Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User\Role\Role withoutTrashed()
 * @mixin \Eloquent
 */
class Role extends LaratrustRole
{
    use SoftDeletes, UuidModel;

    public $incrementing = false;

    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    private $old_attributes = null;
    private $changed_params = null;

    public function getOldAttributes()
    {
        return $this->old_attributes;
    }

    public function setOldAttributes($old_attributes)
    {
        $this->old_attributes = $old_attributes;
    }

    public function getChanges()
    {
        return $this->changed_params??parent::getChanges();
    }

    public function setChanges($changed_params)
    {
        $this->changed_params = $changed_params;
    }
}
