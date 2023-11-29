<?php

namespace App\Http\Resources\Frontend\Api\Service\Category;

use Illuminate\Http\Resources\Json\Resource;

class CategoryCollectionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this;
    }

}
