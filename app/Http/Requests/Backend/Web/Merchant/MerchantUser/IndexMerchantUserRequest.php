<?php


namespace App\Http\Requests\Backend\Web\Merchant\MerchantUser;


use Illuminate\Foundation\Http\FormRequest;

class IndexMerchantUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'full_name' => 'string|nullable',
            'merchant_name' => 'string|nullable',
            'account_number' => 'string|nullable',
            'msisdn' => 'string|nullable',
            'is_active' => 'string|nullable',
        ];
    }
}