<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 15:53
 */

namespace App\Http\Requests\Backend\Web\Merchant\MerchantWorkdays;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantWorkdaysRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'monday' => 'required|max:10',
            'tuesday' => 'required|max:10',
            'wednesday' => 'required|max:10',
            'thursday' => 'required|max:10',
            'friday' => 'required|max:10',
            'saturday' => 'required|max:10',
            'sunday' => 'required|max:10',
        ];
    }
}