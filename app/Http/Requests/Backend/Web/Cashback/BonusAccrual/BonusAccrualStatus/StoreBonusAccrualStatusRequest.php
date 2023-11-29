<?php


namespace App\Http\Requests\Backend\Web\Cashback\BonusAccrual\BonusAccrualStatus;


use Illuminate\Foundation\Http\FormRequest;

class StoreBonusAccrualStatusRequest extends FormRequest
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
            'name' => 'required|max:255',
            'code' => 'required|max:150',
            'is_active' => 'required|alpha_dash',
        ];
    }

}