<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 12:55
 */

namespace App\Http\Requests\Backend\Web\Event;


use Illuminate\Foundation\Http\FormRequest;

class IndexEventRequest extends FormRequest
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