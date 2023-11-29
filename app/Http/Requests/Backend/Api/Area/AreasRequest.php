<?php

namespace App\Http\Requests\Backend\Api\Area;

use App\Http\Requests\Backend\Api\ApiBaseFormRequest;



class AreasRequest extends ApiBaseFormRequest
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
            'id' => 'alpha-dash',
            'region_id' => 'nullable|alpha-dash',
            'name' => 'string',

        ];
    }
}
