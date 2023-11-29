<?php

namespace App\Http\Requests\Backend\Api\Transaction;

use App\Http\Requests\Backend\Api\ApiBaseFormRequest;



class QueueTransactionStatusChangeRequest extends ApiBaseFormRequest
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
            'form_params' => 'required|array',
            'form_params.transaction_id' => 'required|alpha-dash',
            'form_params.status_id' => 'required|alpha-dash',
            'form_params.comment' => 'text',
        ];
    }
}
