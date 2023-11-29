<?php
namespace App\Http\Requests\Backend\Web\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_code' => 'string|nullable',
            'report_type_id' => 'string|nullable',
        ];
    }
}