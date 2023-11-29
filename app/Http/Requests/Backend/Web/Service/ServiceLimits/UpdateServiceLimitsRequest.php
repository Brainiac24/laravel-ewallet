<?php

namespace App\Http\Requests\Backend\Web\Service\ServiceLimits;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceLimitsRequest extends FormRequest
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'params_json' => 'required|string',
            'extend_params_json' => 'required|string',
//            'params_json.day.limit' => 'required|numeric',
//            'params_json.month.limit' => 'required|numeric',
//            'params_json.week.limit' => 'required|numeric',

        ];
    }
}
