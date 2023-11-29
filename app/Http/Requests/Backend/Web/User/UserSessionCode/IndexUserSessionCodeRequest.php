<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 02.09.2019
 * Time: 11:51
 */

namespace App\Http\Requests\Backend\Web\User\UserSessionCode;


use Illuminate\Foundation\Http\FormRequest;

class IndexUserSessionCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'value' => 'string|nullable',
            'user_session_code_type_id' => 'string|nullable',
        ];
    }
}