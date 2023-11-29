<?php

namespace App\Models;

use App\Services\Common\Traits\UuidModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\BaseAuthenticatable
 *
 * @mixin \Eloquent
 */
class BaseAuthenticatable extends Authenticatable
{
    use UuidModel;

    public $incrementing = false;
    private $changed_params = null;

    private $old_attributes = null;

    public function getOldAttributes(): ?array
    {
        return $this->old_attributes;
    }

    public function setOldAttributes($old_attributes): void
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