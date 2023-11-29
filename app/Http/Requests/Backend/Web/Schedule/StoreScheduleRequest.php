<?php


namespace App\Http\Requests\Backend\Web\Schedule;


use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'name' => 'required|max:255',
            'cron_expression' => 'required|cron|max:255',
            'schedule_type_id' => 'required|alpha_dash',
            'is_active' => 'required|alpha_dash|digits_between:0,1',
        ];
    }
}