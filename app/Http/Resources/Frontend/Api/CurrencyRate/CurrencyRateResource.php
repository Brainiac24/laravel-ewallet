<?php

namespace App\Http\Resources\Frontend\Api\CurrencyRate;

use Illuminate\Http\Resources\Json\Resource;

class CurrencyRateResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            //'name' => $this->currency->name,
            //'short_name' => $this->currency->short_name,
            'iso_name' => $this->currency->iso_name,
            //'symbol_left' => $this->currency->symbol_left,
            //'symbol_right' => $this->currency->symbol_right,
            'rate_buy' => $this->value_buy,
            'rate_sell' => $this->value_sell,
        ];


    }
}
