<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 14.11.2019
 * Time: 17:55
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantItem;


use Illuminate\Foundation\Http\FormRequest;

class ChangeAccCodeMerchantItemRequest extends FormRequest
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
            'account_number' => 'required|max:50',
        ];
    }
}