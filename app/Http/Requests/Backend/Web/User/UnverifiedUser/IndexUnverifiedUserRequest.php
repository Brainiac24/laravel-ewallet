<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 11:32
 */

namespace App\Http\Requests\Backend\Web\User\UnverifiedUser;


use Illuminate\Foundation\Http\FormRequest;

class IndexUnverifiedUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'msisdn' => 'string|nullable',
            'devices_json' => 'string|nullable',
        ];
    }
}