<?php


namespace App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointType;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordinatePointTypeRequest extends FormRequest
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
            'code' => 'required|max:50',
            'coordinate_point_workday_id' => 'required|alpha_dash',
            'position' => 'required|numeric',
            'is_show_for_filter' => 'required|alpha_dash',
            'is_active' => 'required|alpha_dash',
        ];
    }

}