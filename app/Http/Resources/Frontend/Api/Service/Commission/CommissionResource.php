<?php

namespace App\Http\Resources\Frontend\Api\Service\Commission;

use Illuminate\Http\Resources\Json\Resource;

class CommissionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->params_json;
    }
}
