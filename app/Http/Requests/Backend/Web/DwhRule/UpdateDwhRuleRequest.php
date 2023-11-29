<?php

namespace App\Http\Requests\Backend\Web\DwhRule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDwhRuleRequest extends FormRequest
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
            'table' => 'required|string',
            'to_dwh_days' => 'integer|nullable',
            'description' => 'string|nullable',
            'delete_from_dwh_days' => 'integer|nullable',
            'job_log_type' => 'integer|nullable',
        ];
    }
}
