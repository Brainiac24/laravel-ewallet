<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 11:15
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantCommission;


use Illuminate\Foundation\Http\FormRequest;

class IndexMerchantCommissionRequest extends FormRequest
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