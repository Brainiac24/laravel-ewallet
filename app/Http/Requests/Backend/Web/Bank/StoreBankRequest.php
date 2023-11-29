<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.07.2019
 * Time: 9:30
 */

namespace App\Http\Requests\Backend\Web\Bank;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBankRequest extends FormRequest
{
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
            'code' => 'required|alpha_dash|unique:banks,code',
            'code_map' => 'required|alpha_dash|unique:banks,code_map',
            'name' => 'required|unique:banks,name|max:255',
            'desc' => 'max:1055',
            'bic' => 'required|alpha_dash|unique:banks,bic',
            'corr_acc' => 'required|alpha_dash|'.$this->uniqueCorrAcc(),
            'position' => 'required|alpha_dash|unique:banks,position,',
            'is_active' => 'required|alpha_dash',
        ];
    }

    public function uniqueCorrAcc()
    {
        $fields = [
            'bic',
            'corr_acc'
        ];

        $rule = Rule::unique('banks');

        foreach ($fields as $field) {

            if (isset($this->$field)) {
                $rule = $rule->where($field, $this->$field);
            }else {
                $rule = $rule->whereNull($field);
            }
        }
    }
}