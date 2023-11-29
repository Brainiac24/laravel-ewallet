<?php


namespace App\Http\Requests\Backend\Web\Merchant\MerchantUser;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'is_active' => 'required|alpha_dash',
            'is_approved' => 'required|alpha_dash',
        ];
    }
}