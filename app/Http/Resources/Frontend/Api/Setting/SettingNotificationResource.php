<?php

namespace App\Http\Resources\Frontend\Api\Setting;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class SettingNotificationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'comment' => $this->comment,
            'is_active' => (string)$this->is_active,
        ];
        //dd(Auth::user());
        $setting = Auth::user()->user_settings_json;
        if ($setting !== null) {
            foreach ($setting as $value) {
                if ($value['code'] == $this->code) {
                    if (isset($value['is_active'])) {
                        $data['is_active'] = (string) $value['is_active'];
                    } 
                }
            }
        }

        return $data;
    }
}
