<?php

namespace App\Http\Requests\Backend\Web\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
        //dd($this->comment);
        return [
//            'transaction_status_id' => 'required|alpha_dash|transactions,transaction_status_id,'.$this->transaction_status_id,
            'transaction_status_id' => 'required|alpha_dash',
            'send_to_processing' => 'alpha_dash',
            'is_queued' => 'alpha_dash',//.$this->is_queued,
            'comment' => 'required|max:1055,'.$this->comment
        ];
    }
}
