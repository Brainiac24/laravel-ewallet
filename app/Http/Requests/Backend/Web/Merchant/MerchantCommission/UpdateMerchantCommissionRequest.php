<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 24.02.2020
 * Time: 11:11
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantCommission;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantCommissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'required|alpha_dash'
        ];
    }
}