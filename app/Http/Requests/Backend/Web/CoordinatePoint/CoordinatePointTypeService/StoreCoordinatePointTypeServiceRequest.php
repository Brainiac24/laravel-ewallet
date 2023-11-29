<?php


namespace App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointTypeService;


use Illuminate\Foundation\Http\FormRequest;

class StoreCoordinatePointTypeServiceRequest extends FormRequest
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
            'coordinate_point_type_id' => 'required|alpha_dash',
            'coordinate_point_service_id' => 'required|alpha_dash',
            'is_active' => 'required|alpha_dash',
        ];
    }
}