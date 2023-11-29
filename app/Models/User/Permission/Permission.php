<?php

namespace App\Models\User\Permission;

use App\Services\Common\Traits\UuidModel;
use Laratrust\Models\LaratrustPermission;

/**
 * App\Models\User\Permission\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Role\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Permission\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends LaratrustPermission
{
    use UuidModel;

    public $incrementing = false;
}
