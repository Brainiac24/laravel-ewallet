<?php

namespace App\Http\Requests\Frontend\Api\CoordinatePoints;

use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;


class IndexCoordinatePointsRequest extends ApiBaseFormRequest
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
        ];
    }
}
