<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 10:35
 */

namespace App\Http\Requests\Backend\Web\Bank;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBankRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|alpha_dash|unique:banks,code,' . $this->bank,
            'code_map' => 'required|alpha_dash|unique:banks,code_map,' . $this->bank,
            'name' => 'required|unique:banks,name,' . $this->bank,
            'desc' => 'max:1055',
            'bic' => 'required|alpha_dash|unique:banks,bic,' . $this->bank,
            'corr_acc' => 'required|alpha_dash|'.$this->uniqueCorrAcc(),
            'position' => 'required|alpha_dash|unique:banks,position,' . $this->bank,
            'is_active' => 'required|alpha_dash',
        ];
    }

    public function uniqueCorrAcc()
    {
        $fields = [
            'bic',
            'corr_acc'
        ];
        $rule = Rule::unique('banks')->ignore($this->bank);

        foreach ($fields as $field) {

            if (isset($this->$field)) {
                $rule = $rule->where($field, $this->$field);
            }else {
                $rule = $rule->whereNull($field);
            }
        }

        return $rule;
    }
}