<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.2019
 * Time: 14:19
 */

namespace App\Http\Requests\Backend\Web\JobLog;


use Illuminate\Foundation\Http\FormRequest;

class IndexJobLogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'created_by_user_ids' => 'array|nullable',
            'created_by_user_msisdn' => 'numeric|nullable',
            'transaction_id' => 'string|nullable',
            'order_id' => 'string|nullable',
            'is_from_archive' => 'nullable|boolean',
            'type' => 'nullable|integer',
            'from_date' => 'nullable|date',
            'to_date' => 'date|nullable|required_with_all:from_date|after_or_equal:from_date|valid_date_range_diff_in_day_if:from_date,31,export',
        ];
    }
}