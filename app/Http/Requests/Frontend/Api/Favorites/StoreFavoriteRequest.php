<?php

namespace App\Http\Requests\Frontend\Api\Favorites;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;


class StoreFavoriteRequest extends ApiBaseFormRequest
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
            'name' => 'nullable|string',
            'service_id' => 'required|alpha_dash',
            'amount' => 'required|numeric',
            'params' => 'required|array',
            'params.*.key' => 'required|string',
            'params.*.value' => 'required|string',
        ];
    }
}
