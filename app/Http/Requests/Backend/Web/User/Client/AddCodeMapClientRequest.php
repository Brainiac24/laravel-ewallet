<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.08.2019
 * Time: 16:56
 */

namespace App\Http\Requests\Backend\Web\User\Client;


use Illuminate\Foundation\Http\FormRequest;

class AddCodeMapClientRequest extends FormRequest
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
        $id = $this->id;

        return [
            'code_map' => 'numeric|required|unique:users,code_map,'.$id ,
        ];
    }
}