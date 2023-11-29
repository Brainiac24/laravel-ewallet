<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 17:13
 */

namespace App\Http\Requests\Frontend\Api\User\Auth;


use App\Http\Requests\Frontend\Api\ApiBaseFormRequest;

class ResetRegisterPinRequest extends ApiBaseFormRequest
{

    protected $isShowCustomMessage = false;

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
            'code' => 'required|numeric|digits_between:4,30',
        ];
    }
}