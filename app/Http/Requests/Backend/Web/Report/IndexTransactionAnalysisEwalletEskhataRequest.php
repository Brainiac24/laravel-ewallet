<?php


namespace App\Http\Requests\Backend\Web\Report;


use Illuminate\Foundation\Http\FormRequest;

class IndexTransactionAnalysisEwalletEskhataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'report_analysis_id' => 'string|nullable',
            'from_created_at' => 'date|nullable',
            'to_created_at' => 'date|nullable|required_with_all:from_created_at,export|after_or_equal:from_created_at|valid_date_range_diff_in_day_if:from_created_at,31,export',
            'report_type_id' => 'string|required',
            'export' => 'nullable'
        ];
    }
}