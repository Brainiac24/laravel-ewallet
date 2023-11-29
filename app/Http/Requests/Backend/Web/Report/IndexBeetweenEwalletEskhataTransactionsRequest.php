<?php

namespace App\Http\Requests\Backend\Web\Report;

use Illuminate\Foundation\Http\FormRequest;

class IndexBeetweenEwalletEskhataTransactionsRequest extends FormRequest
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
            'from_date_finish' => 'date|nullable',
            'to_date_finish' => 'date|nullable|required_with_all:from_date_finish,export|after_or_equal:from_date_finish|valid_date_range_diff_in_day_if:from_date_finish,31,export',
            'export' => 'nullable',
            'transaction_status_id' => 'alpha_dash|nullable',
            'from_account_id' => 'numeric|nullable',
            'to_account_msisdn' => 'numeric|nullable',
            'report_type_id' => 'string|nullable',
        ];
    }
}
