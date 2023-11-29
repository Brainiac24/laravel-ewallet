<?php


namespace App\Http\Requests\Backend\Web\Transaction\TransactionContinueRuleAccordance;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionContinueRuleAccordanceRequest extends FormRequest
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
            'transaction_continue_rule_id' => 'required|alpha_dash',
            'message' => 'required|string|nullable',
            'is_active' => 'required|alpha_dash',
            'transaction_sync_status_id' =>'required_without:transaction_status_id|'. $this->customRule(),
            'transaction_status_id' =>'required_without:transaction_sync_status_id|'. $this->customRule(),
        ];
    }

    protected function customRule()
    {
        $fields = [
            'transaction_sync_status_id',
            'transaction_status_id',
        ];
        $rule = Rule::unique('transaction_continue_rule_accordance')->ignore($this->id);
        $rule = $rule->where('transaction_continue_rule_id', $this->transaction_continue_rule_id);
        foreach ($fields as $field)
        {
            if (isset($this->$field)) {
                $rule = $rule->where($field, $this->$field);
            }else {
                $rule = $rule->whereNull($field);
            }
        }

        return $rule;
    }
}