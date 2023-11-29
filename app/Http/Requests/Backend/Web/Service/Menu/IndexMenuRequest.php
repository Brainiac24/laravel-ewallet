<?php

namespace App\Http\Requests\Backend\Web\Service\Menu;

use Illuminate\Foundation\Http\FormRequest;

class IndexMenuRequest extends FormRequest
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
            'processing_code' => 'string|nullable',
            'name' => 'string|nullable',
            'params_json' => 'string|nullable',
            'is_active'=>'numeric|nullable',
        ];
    }
}
