<?php

namespace App\Http\Requests\Backend\Api\Region;

use App\Http\Requests\Backend\Api\ApiBaseFormRequest;



class RegionsRequest extends ApiBaseFormRequest
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
            'country_id' => 'nullable|alpha-dash',
            'name' => 'string',

        ];
    }
}
