<?php

namespace App\Http\Requests\Backend\Web\Service\Commission;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCommissionDataRequest extends FormRequest
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
            'params.id'=>'required|alpha_dash',
        ];
    }
}
