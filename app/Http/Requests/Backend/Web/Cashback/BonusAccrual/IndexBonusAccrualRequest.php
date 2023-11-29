<?php


namespace App\Http\Requests\Backend\Web\Cashback\BonusAccrual;


use Illuminate\Foundation\Http\FormRequest;

class IndexBonusAccrualRequest extends FormRequest
{
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
            'from_user_full_name' => 'string|nullable',
            'cashback_id' => 'alpha_dash|nullable',
            'bonus_accrual_status_id' => 'alpha_dash|nullable',
        ];
    }

}