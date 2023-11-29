<?php


namespace App\Http\Requests\Backend\Web\Schedule\ScheduleJob;


use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleJobRequest extends FormRequest
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
            'schedule_type_id' => 'required|alpha_dash',
            'from_date' => 'required|date|after_or_equal:'.Carbon::now(),
        ];
    }
}