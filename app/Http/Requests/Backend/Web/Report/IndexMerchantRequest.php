<?php

namespace App\Http\Requests\Backend\Web\Report;


use Illuminate\Foundation\Http\FormRequest;

class IndexMerchantRequest extends FormRequest
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
            'organization' => 'string|nullable',
            'parent_id' => 'string|nullable',
            'branch_id' => 'string|nullable',
            'is_verified' => 'string|nullable',
            'is_active' => 'string|nullable',
            'from_created_at' => 'date|nullable',
            'to_created_at' => 'date|nullable|after_or_equal:from_created_at',
            'report_type_id' => 'string|nullable',
            'export' => 'nullable'
        ];
    }
}