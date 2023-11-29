<?php

namespace App\Http\Resources\Frontend\Api\Favorite;

use App\Http\Resources\Frontend\Api\Service\ServiceResource;
use App\Services\Common\Helpers\Helper;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class FavoriteResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $params = null;
        foreach ($this->params_json as $value) {
            if ($value['key'] == 'phone_number' || $value['key'] == 'comment' || $value['key'] == 'to_account') {
                $params[] = $value;
            }
        }
        return [
            'name' => $this->name,
            'value' => Helper::roundTo2dp($this->value),
            'params' => $params,
            'service' => new ServiceResource($this->service),
        ];
    }
}
