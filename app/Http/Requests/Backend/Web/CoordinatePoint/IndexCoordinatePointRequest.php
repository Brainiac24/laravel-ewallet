<?php

namespace App\Http\Requests\Backend\Web\CoordinatePoint;

use Illuminate\Foundation\Http\FormRequest;

class IndexCoordinatePointRequest extends FormRequest
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
            'objt' => 'numeric|nullable',
            'is_active' => 'numeric|nullable',
            'merchant_id' => 'alpha_dash|nullable',
            'coordinate_point_type_id' => 'alpha_dash|nullable',
            'coordinate_point_workday_id' => 'alpha_dash|nullable',
            'name' => 'string|nullable',
            'address' => 'string|nullable',
        ];
    }
}
