<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.12.2019
 * Time: 15:06
 */

namespace App\Http\Requests\Backend\Web\Cashback\CashbackItem;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCashbackItemRequest extends FormRequest
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
            'name' => 'required|max:255',
//            'min' => 'required|numeric',
//            'max' => 'required|numeric',
            'value' => 'required|numeric',
            'is_percentage' => 'required|alpha_dash',
//            'is_active' => 'required|alpha_dash',
        ];
    }
}