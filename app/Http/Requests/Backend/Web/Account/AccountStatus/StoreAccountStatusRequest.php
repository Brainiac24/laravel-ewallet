<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05.04.2019
 * Time: 17:31
 */

namespace App\Http\Requests\Backend\Web\Account\AccountStatus;


use Illuminate\Foundation\Http\FormRequest;

class StoreAccountStatusRequest extends FormRequest
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
            'code_map' => 'required|alpha_dash|unique:account_status,code_map',
            'name' => 'required|unique:account_status,name|max:255',
            'is_active' => 'required|alpha_dash',
        ];
    }
}