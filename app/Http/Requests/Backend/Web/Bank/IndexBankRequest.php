<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.07.2019
 * Time: 18:14
 */

namespace App\Http\Requests\Backend\Web\Bank;


use Illuminate\Foundation\Http\FormRequest;

class IndexBankRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',//'required|alpha_dash',
            'name' => 'string|nullable',//'required|alpha_dash',
            'code' => 'string|nullable',
            'code_map' => 'string|nullable',
            'bic' => 'string|nullable',
            'corr_acc' => 'string|nullable',
            'is_active' => 'numeric|nullable',
            'created_at' => 'date|nullable',
        ];
    }
}