<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 31.07.2019
 * Time: 19:09
 */

namespace App\Http\Requests\Backend\Web\DocumentType;


use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|alpha_dash|unique:document_types,code,' . $this->documentType,
            'code_map' => 'required|alpha_dash|unique:document_types,code_map,' . $this->documentType,
            'name' => 'required|unique:document_types,name,' . $this->documentType,
            'desc' => 'max:1055',
            'is_active' => 'required|alpha_dash',
        ];
    }
}