<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 16:24
 */

namespace App\Http\Requests\Backend\Web\TransferList;


use Illuminate\Foundation\Http\FormRequest;

class StoreTransferListRequest extends FormRequest
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
            'code' => 'required|alpha_dash|unique:transfer_lists,code',
            'code_map' => 'required|alpha_dash|unique:transfer_lists,code_map',
            'name' => 'required|unique:transfer_lists,name|max:255',
            'icon_url' => 'nullable|string',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
        ];
    }
}