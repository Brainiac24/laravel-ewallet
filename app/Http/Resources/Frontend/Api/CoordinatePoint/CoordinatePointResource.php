<?php

namespace App\Http\Resources\Frontend\Api\CoordinatePoint;

use Illuminate\Http\Resources\Json\Resource;

class CoordinatePointResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            //'name' => $this->currency->name,
            //'short_name' => $this->currency->short_name,
            'name'=> $this->name,
            'lat'=> $this->latitude,
            'lon'=> $this->longitude,
            'addr'=> $this->address,
            'objt'=> $this->object_type,

        ];
    }
}
