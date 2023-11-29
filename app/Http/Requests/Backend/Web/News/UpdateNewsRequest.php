<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 11:28
 */

namespace App\Http\Requests\Backend\Web\News;


use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:255|required',
            'short_description' => 'max:191|required',
            'description' => 'required|min:10',
            'tags' => 'max:191',
            'is_active' => 'required|alpha_dash',
            'is_push_notification' => 'alpha_dash',
            'position' => 'numeric|nullable',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
            'image_name' => 'image|max:2048|min:10'
        ];
    }
}