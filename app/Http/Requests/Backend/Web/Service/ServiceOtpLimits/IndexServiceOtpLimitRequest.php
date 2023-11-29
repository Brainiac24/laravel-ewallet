<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 9:44
 */

namespace App\Http\Requests\Backend\Web\Service\ServiceOtpLimits;


use Illuminate\Foundation\Http\FormRequest;

class IndexServiceOtpLimitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'name' => 'string|nullable'
        ];
    }
}