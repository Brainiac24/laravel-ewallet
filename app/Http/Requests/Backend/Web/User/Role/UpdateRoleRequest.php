<?php

namespace App\Http\Requests\Backend\Web\User\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name,' . $this->role,
            'display_name' => 'required',
            'permission_ids.*' => 'alpha_dash'
        ];
    }
}
