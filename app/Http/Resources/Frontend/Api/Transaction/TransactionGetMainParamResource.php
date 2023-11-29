<?php

namespace App\Http\Resources\Frontend\Api\Transaction;

use Illuminate\Http\Resources\Json\Resource;

class TransactionGetMainParamResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $params_value = null;
        foreach ($this->service->params_json as $value) {
            foreach ($this->params_json as $value2) {
                if (isset($value['is_main'])) {
                    if ($value['is_main'] == 1 && $value['input_name'] == $value2['input_name']) {
                        $params_value = $value2;
                    }
                }
            }
        }

        if ($params_value == null) {
            if (isset($this->params_json[0])) {
                $params_value = $this->params_json[0];
            }
        }

        return [
            'value' => $params_value['input_name'],
        ];
    }
}
