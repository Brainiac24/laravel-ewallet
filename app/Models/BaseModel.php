<?php

namespace App\Models;

use App\Services\Common\Traits\UuidModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use UuidModel {
        UuidModel::boot as boot_uuid;
    }

    protected static function boot()
    {
        self::boot_uuid();
    }

    public $incrementing = false;

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
        return $this->changed_params ?? parent::getChanges();
    }

    public function setChanges($changed_params)
    {
        $this->changed_params = $changed_params;
    }

}