<?php

namespace App\Http\Resources\Frontend\Api\Transaction\TransactionStatusGroup;

use Illuminate\Http\Resources\Json\Resource;

class TransactionStatusGroupResource extends Resource
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
            'code'=> $this->code,
            'name'=> $this->name,
            //'color'=> $this->color,
        ];
    }
}
