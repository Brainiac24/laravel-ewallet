<?php


namespace App\Http\Requests\Backend\Web\Transaction\TransactionContinueRule;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionContinueRuleRequest extends FormRequest
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
            'is_active' => 'required|alpha_dash',
//            'transaction_sync_status_id' => 'required|unique:transaction_continue_rules,transaction_sync_status_id,'.$this->id??null.',id,from_gateway_id,'.$this->from_gateway_id.',transaction_status_id'.$this->transaction_status_id.',to_gateway_id'.$this->to_gateway_id,
//            'from_gateway_id' => 'required|unique:transaction_continue_rules,from_gateway_id,'.$this->id??null.',id,transaction_sync_status_id,'.$this->transaction_sync_status_id.',transaction_status_id'.$this->transaction_status_id.',to_gateway_id'.$this->to_gateway_id,
//            'to_gateway_id' => 'required|unique:transaction_continue_rules,to_gateway_id,'.$this->id??null.',id,from_gateway_id,'.$this->from_gateway_id.',transaction_status_id'.$this->transaction_status_id.',transaction_sync_status_id'.$this->transaction_sync_status_id,
//            'transaction_status_id' => 'required|unique:transaction_continue_rules,transaction_status_id,'.$this->id??null.',id,from_gateway_id,'.$this->from_gateway_id.',transaction_sync_status_id'.$this->transaction_sync_status_id.',to_gateway_id'.$this->to_gateway_id,
            'transaction_sync_status_id' =>'nullable|alpha_dash|'. $this->customRule(),
            'from_gateway_id' => 'required|alpha_dash|'. $this->customRule(),
            'to_gateway_id' => 'required|alpha_dash|'. $this->customRule(),
            'transaction_status_id' => 'required|alpha_dash|'. $this->customRule(),
        ];
    }

    protected function customRule()
    {
        $fields = [
            'from_gateway_id',
            'to_gateway_id',
            'transaction_status_id',
        ];
        $rule = Rule::unique('transaction_continue_rules');
        foreach ($fields as $field)
        {
            $rule = $rule->where($field, $this->{$field});
        }
        if (isset($this->transaction_sync_status_id)) {
            $rule = $rule->where('transaction_sync_status_id', $this->transaction_sync_status_id);
        }else {
            $rule = $rule->whereNull('transaction_sync_status_id');
        }
        return $rule;
    }

}