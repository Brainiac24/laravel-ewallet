<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 10:23
 */

namespace App\Http\Requests\Backend\Web\News;


use Illuminate\Foundation\Http\FormRequest;

class IndexNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'title' => 'string|nullable'
        ];
    }
}