<?php

namespace App\Http\Requests\Backend\Web\Service\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
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
            'code' => 'required|max:255|unique:categories,code,'.$this->category,
            'name' => 'required|max:255',
            'parent_id' => 'required|alpha_dash',
            'is_active' => 'required|numeric',
            'is_enabled' => 'required|numeric',
            'position' => 'required|numeric',
            'icon_url' => 'required|max:255',
            'is_searchable' => 'required|numeric',
        ];
    }
}
