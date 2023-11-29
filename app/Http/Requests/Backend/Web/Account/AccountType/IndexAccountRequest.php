<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 06.09.2019
 * Time: 10:00
 */

namespace App\Http\Requests\Backend\Web\Account\AccountType;


use Illuminate\Foundation\Http\FormRequest;

class IndexAccountRequest extends FormRequest
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
            'name' => 'string|nullable',
            'code_map' => 'string|nullable',
            ];
    }
}