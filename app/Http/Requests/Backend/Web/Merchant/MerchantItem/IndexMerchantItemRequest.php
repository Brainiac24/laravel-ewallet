<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 14:56
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantItem;


use Illuminate\Foundation\Http\FormRequest;

class IndexMerchantItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'name' => 'string|nullable',
            'merchant_id' => 'string|nullable'
        ];
    }
}