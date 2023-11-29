<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 21.08.2019
 * Time: 16:06
 */

namespace App\Http\Requests\Backend\Web\User\TempUser;


use Illuminate\Foundation\Http\FormRequest;

class IndexTempUsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'full_name' => 'string|nullable',
            'msisdn' => 'string|nullable',
            'code_map' => 'string|nullable',
        ];
    }
}