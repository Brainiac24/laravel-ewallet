<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 29.08.2019
 * Time: 16:27
 */

namespace App\Http\Requests\Backend\Web\TransferList;


use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferListRequest extends FormRequest
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
            'code' => 'required|max:255|unique:transfer_lists,code,'.$this->transferList,
            'code_map' => 'required|max:255|unique:transfer_lists,code_map,'.$this->transferList,
            'name' => 'required|max:255|unique:transfer_lists,name,'.$this->transferList,
            'desc' => 'max:1055',
            'icon_url' => 'nullable|string',
            'is_active' => 'required|alpha_dash',
        ];
    }
}