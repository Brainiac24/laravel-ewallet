<?php


namespace App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointWorkday;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordinatePointWorkdayRequest extends FormRequest
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
            'name' => 'required|max:255|unique:coordinate_point_workdays,name,'.$this->coordinatepointWorkday,
            'monday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'tuesday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'wednesday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'thursday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'friday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'saturday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'sunday' => 'required|max:255|regex:/^\d{1,2}-\d{1,2}$/',
            'is_active' => 'required|alpha_dash',
        ];
    }

}