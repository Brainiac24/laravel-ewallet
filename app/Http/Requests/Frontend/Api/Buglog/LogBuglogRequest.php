<?php

namespace App\Http\Requests\Frontend\Api\Buglog;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;


class LogBuglogRequest extends ApiBaseFormRequest
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
            'tag' => 'string|nullable',
            'link' => 'string|nullable',
            'response' => 'string|nullable',
            'error' => 'string|nullable',
            'token' => 'string|nullable',
            'os' => 'string|nullable',
            'version' => 'string|nullable',
            'msisdn' => 'string|nullable',
        ];
    }
}
