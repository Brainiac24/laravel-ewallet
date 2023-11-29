<?php

namespace App\Http\Requests\Backend\Web\CoordinatePoint;

use App\Services\Common\Helpers\CoordinatePoints\MatchCoordinatePointTypes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordinatePointRequest extends FormRequest
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
            'name' => 'required|max:255|unique:coordinate_points,name,'.$this->coordinatepoint,
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'coordinate_point_workday_id' => 'alpha_dash|nullable',
            'coordinate_point_type_id' => 'required|alpha_dash',
            'merchant_id' =>'alpha_dash|nullable|required_if:coordinate_point_type_id,'.MatchCoordinatePointTypes::QR,
            'address' => 'required|max:255',
            'coordinate_point_city_id' => 'required|alpha_dash',
            'is_active' => 'required|numeric',
            ];
    }
}
