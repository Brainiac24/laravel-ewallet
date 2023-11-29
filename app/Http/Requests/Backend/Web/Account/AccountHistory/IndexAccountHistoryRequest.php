<?php


namespace App\Http\Requests\Backend\Web\Account\AccountHistory;


use Illuminate\Foundation\Http\FormRequest;

class IndexAccountHistoryRequest extends FormRequest
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
            'from_date' => 'date|nullable',
            'to_date' => 'date|nullable|required_with_all:from_date,export|after_or_equal:from_date|valid_date_range_diff_in_day_if:from_date,31,export',
            'transaction_type_id' => 'alpha_dash|nullable',
            'transaction_status_id' => 'alpha_dash|nullable',
            'report_type_id' => 'string|nullable',
            'export' => 'nullable'
        ];
    }
}