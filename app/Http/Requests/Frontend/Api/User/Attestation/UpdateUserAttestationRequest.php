<?php

namespace App\Http\Requests\Frontend\Api\User\Attestation;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;

class UpdateUserAttestationRequest extends ApiBaseFormRequest
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
        //$id = $this->route('user');

        return [
            'id' => 'required|alpha_dash',
            'confirm' => 'required|boolean',
        ];
    }
}
