<?php

namespace App\Http\Requests\Frontend\Api\User;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;

class UpdateUserRequest extends ApiBaseFormRequest
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
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'date_birth' => 'nullable|date',
            'gender' => 'nullable|boolean',
            'photo' => 'nullable|image',
        ];
    }
}
