<?php


namespace App\Http\Requests\Backend\Web\Report\ReportAnalysis;


use Illuminate\Foundation\Http\FormRequest;

class StoreReportAnalysisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'required|max:255|unique:report_analyzes,name',
            'is_active' => 'required|alpha_dash',
            'params_json.expenseServices'=>'required|array|min:1',
            'params_json.incomeServices'=>'required|array|min:1',
            'params_json.incomeAccountTypes'=>'nullable|array',
            'params_json.expenseAccountTypes'=>'nullable|array',
            'params_json.expenseServices.*'=>'required|alpha_dash',
            'params_json.incomeServices.*'=>'required|alpha_dash',
            'params_json.incomeAccountTypes.*'=>'nullable|alpha_dash',
            'params_json.expenseAccountTypes.*'=>'nullable|alpha_dash',
        ];
    }

}