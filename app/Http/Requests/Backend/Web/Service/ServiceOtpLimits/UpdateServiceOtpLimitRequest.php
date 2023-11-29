<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:45
 */

namespace App\Http\Requests\Backend\Web\Service\ServiceOtpLimits;


use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceOtpLimitRequest extends FormRequest
{
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'params_json' => 'required|string',
        ];
    }
}