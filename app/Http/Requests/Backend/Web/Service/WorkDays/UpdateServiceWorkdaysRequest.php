<?php

namespace App\Http\Requests\Backend\Web\Service\WorkDays;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceWorkdaysRequest extends FormRequest
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
            'name' => 'required|max:255|unique:workdays,name,'.$this->workday,
            'monday' => 'required|max:255',
            'tuesday' => 'required|max:255',
            'wednesday' => 'required|max:255',
            'thursday' => 'required|max:255',
            'friday' => 'required|max:255',
            'saturday' => 'required|max:255',
            'sunday' => 'required|max:255'
        ];
    }
}
