<?php

namespace App\Http\Requests\Backend\Web\User\Attestation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttestationRequest extends FormRequest
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
            'code' => 'required|max:255|unique:attestations,code',
            'name' => 'required|max:255|unique:attestations,name',
            'params_json' => 'required|array',

        ];
    }
}
