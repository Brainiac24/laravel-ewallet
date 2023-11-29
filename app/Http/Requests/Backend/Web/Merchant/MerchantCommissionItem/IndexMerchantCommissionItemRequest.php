<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 13:53
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantCommissionItem;


use Illuminate\Foundation\Http\FormRequest;

class IndexMerchantCommissionItemRequest extends FormRequest
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
        ];
    }
}