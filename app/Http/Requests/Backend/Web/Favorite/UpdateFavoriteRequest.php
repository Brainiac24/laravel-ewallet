<?php

namespace App\Http\Requests\Backend\Web\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFavoriteRequest extends FormRequest
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
            'name' => 'required|max:255',
            'value' => 'required|max:255',
            'params_json' => 'required|max:1000',
            'service_id' => 'required|alpha_dash',
            'user_id' => 'required|alpha_dash',

        ];
    }
}
