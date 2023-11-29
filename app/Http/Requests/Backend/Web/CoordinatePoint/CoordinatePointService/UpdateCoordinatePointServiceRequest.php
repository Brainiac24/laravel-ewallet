<?php


namespace App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointService;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordinatePointServiceRequest extends FormRequest
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
            'name' => 'required|max:255|unique:coordinate_point_services,name,'.$this->coordinatepointService,
            'position' => 'required|numeric',
            'is_show_for_filter' => 'required|alpha_dash',
            'is_active' => 'required|alpha_dash',
        ];
    }

}