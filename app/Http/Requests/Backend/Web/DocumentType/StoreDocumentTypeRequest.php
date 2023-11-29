<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.07.2019
 * Time: 15:23
 */

namespace App\Http\Requests\Backend\Web\DocumentType;


use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'code' => 'required|alpha_dash|unique:document_types,code',
            'code_map' => 'required|unique:document_types,code_map|max:255',
            'name' => 'required|unique:document_types,name|max:255',
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
        ];
    }
}