<?php

namespace App\Http\Resources\Frontend\Api\Transaction\TransactionStatusDetail;

use Illuminate\Http\Resources\Json\Resource;

class TransactionStatusDetailResource extends Resource
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
            'color'=> $this->color,
        ];
    }
}
