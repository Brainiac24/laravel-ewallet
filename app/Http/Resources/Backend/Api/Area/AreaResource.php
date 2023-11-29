<?php

namespace App\Http\Resources\Backend\Api\Area;

use Illuminate\Http\Resources\Json\Resource;

class AreaResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "text" => $this->name
        ];
    }
}
