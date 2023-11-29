<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 07.09.2021
 * Time: 16:12
 */

namespace App\Http\Requests\Backend\Web\Order\OrderCardType;


use Illuminate\Foundation\Http\FormRequest;

class IndexOrderCardTypeRequest extends FormRequest
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
            'id' => 'string|nullable',
            'code_map' => 'string|nullable',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'year' => 'nullable|numeric',
            'currency_id' => 'nullable|alpha_dash',
            'is_active' => 'nullable|numeric',

        ];
    }
}