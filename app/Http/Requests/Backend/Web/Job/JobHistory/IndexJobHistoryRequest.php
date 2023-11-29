<?php

namespace App\Http\Requests\Backend\Web\Job\JobHistory;


use Illuminate\Foundation\Http\FormRequest;

class IndexJobHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|nullable',
            'status' => 'numeric|nullable',
        ];
    }
}