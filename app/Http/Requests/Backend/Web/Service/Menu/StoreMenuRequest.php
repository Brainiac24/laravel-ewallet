<?php

namespace App\Http\Requests\Backend\Web\Service\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'service_id' => 'required|alpha_dash',
            'category_id' => 'required|alpha_dash',
            'position' => 'required|numeric'
        ];
    }
}
