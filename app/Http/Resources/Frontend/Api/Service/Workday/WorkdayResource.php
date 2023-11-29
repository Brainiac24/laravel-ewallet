<?php

namespace App\Http\Resources\Frontend\Api\Service\Workday;

use Illuminate\Http\Resources\Json\Resource;

class WorkdayResource extends Resource
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
            'w1'=> $this->monday,
            'w2'=> $this->tuesday,
            'w3'=> $this->wednesday,
            'w4'=> $this->thursday,
            'w5'=> $this->friday,
            'w6'=> $this->saturday,
            'w7'=> $this->sunday,
        ];
    }
}
