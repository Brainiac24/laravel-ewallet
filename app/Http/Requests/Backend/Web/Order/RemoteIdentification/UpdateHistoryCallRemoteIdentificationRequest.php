<?php

namespace App\Http\Requests\Backend\Web\Order\RemoteIdentification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistoryCallRemoteIdentificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'call_comment' => 'required_if:history_comment,|alpha_dash|nullable:',
            'history_comment' => 'required_if:call_comment,|string|nullable',
        ];
    }
}