<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 17:50
 */

namespace App\Http\Requests\Backend\Web\Cashback;


use Illuminate\Foundation\Http\FormRequest;

class StoreCashbackRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required|date|after:start_date',
            'address' => 'max:255',
            'is_active' => 'required|alpha_dash',
        ];
    }
}