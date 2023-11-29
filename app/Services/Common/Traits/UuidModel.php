<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 05.06.2018
 * Time: 9:27
 */

namespace App\Services\Common\Traits;

use Ramsey\Uuid\Uuid;

trait UuidModel
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        
        parent::boot();
        static::creating(function ($model) {

            if (empty($model->{$model->getKeyName()}) || $model->{$model->getKeyName()} == null) {
                $model->{$model->getKeyName()} = (string)Uuid::uuid4();
            }

        });
    }

}