<?php

namespace App\Http\Requests\Backend\Web\Service\Commission;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommissionDataRequest extends FormRequest
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
            'params.min'=>'required|numeric',
            'params.max'=>'required|numeric',
            'params.value'=>'required|numeric',
            'params.is_percentage'=>'required|boolean'
        ];
    }
}
