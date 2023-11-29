<?php

namespace App\Http\Requests\Frontend\Api\Setting;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SettingNotificationRequest extends ApiBaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|string',
            'is_active' => 'required|numeric|digits_between:0,1',
        ];
    }
}
