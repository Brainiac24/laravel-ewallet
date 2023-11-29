<?php

namespace App\Http\Requests\Backend\Web\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class IndexFavoriteRequest extends FormRequest
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
            'msisdn' => 'numeric|nullable',
            'params_json' => 'string|nullable',
        ];
    }
}
