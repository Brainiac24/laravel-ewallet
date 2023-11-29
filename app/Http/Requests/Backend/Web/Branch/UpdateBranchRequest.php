<?php


namespace App\Http\Requests\Backend\Web\Branch;


use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:150|unique:branches,code,'.$this->branch,
            'code_map' => 'required|string|max:255',
            'acc_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'address' => 'required|string',
            'params_json' => 'nullable|string',
            'branch_user_id' => 'required|numeric',
            'is_active' => 'required|alpha_dash',
        ];
    }
}