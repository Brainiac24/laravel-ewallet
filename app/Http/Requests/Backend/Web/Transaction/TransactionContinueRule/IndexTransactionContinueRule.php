<?php


namespace App\Http\Requests\Backend\Web\Transaction\TransactionContinueRule;


use Illuminate\Foundation\Http\FormRequest;

class IndexTransactionContinueRule extends FormRequest
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
            'id'=>'alpha_dash|nullable',
            'transaction_status_id' => 'alpha_dash|nullable',
            'transaction_sync_status_id' => 'alpha_dash|nullable',
            'from_gateway_id' => 'alpha_dash|nullable',
            'to_gateway_id' => 'alpha_dash|nullable',
            'is_active' => 'alpha_dash|nullable',
        ];
    }

}