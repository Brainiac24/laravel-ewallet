<?php


namespace App\Http\Requests\Backend\Web\CoordinatePoint\CoordinatePointCity;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCoordiantePointCityRequest extends FormRequest
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
            'version' => 'required|numeric',
            'city_id' => 'alpha_dash|nullable',
            'is_active' => 'required|numeric',
        ];
    }
}