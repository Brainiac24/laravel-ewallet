<?php

namespace App\Http\Resources\Frontend\Api\Favorite;

use App\Services\Common\Helpers\Helper;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class FavoriteListResource extends Resource
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
                if ($value['input_name'] == 'phone_number' || $value['input_name'] == 'comment' || $value['input_name'] == 'to_account') {
                    if (isset($value['is_main'])) {
                        if ($value['is_main'] == 1 && $value['input_name'] == $value2['key']) {
                            $params_value[] = $value2;
                            //$value2['name'] = $value['input_placeholder'];
                        }
                    }
                }
            }
        }

        if ($params_value == null) {
            if (isset($this->params_json[0])) {
                $params_value[] = $this->params_json[0];
            }
        }

        //dd($this->service->categories[0]->name);

        //ХАРДКОД Auth::user()->load('accounts')->accounts[0]->id, сохранять аккаунт транзакции с которой была осуществлена транзакция для шаблона и вывести на эту строчку
        return [
            'id' => $this->id,
            'name' => !empty($this->name)?$this->name:$this->service->categories[0]->name,
            'currency_iso' => $this->service->currency->iso_name,
            'service_name' => $this->service->name,
            'service_id' => $this->service->id,
            'service_icon' => $this->service->icon_url,
            //ХАРДКОД ->accounts[0]
            'from_account_id' => Auth::user()->load('accounts')->accounts[0]->id,
            'value' => Helper::roundTo2dp($this->value),
            'params' => $params_value,
        ];
    }
}
