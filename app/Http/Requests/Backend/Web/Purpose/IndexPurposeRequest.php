<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.08.2019
 * Time: 10:35
 */

namespace App\Http\Requests\Backend\Web\Purpose;


use Illuminate\Foundation\Http\FormRequest;

class IndexPurposeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'code_map' => 'string|nullable',
            'name' => 'string|nullable',
        ];
    }
}