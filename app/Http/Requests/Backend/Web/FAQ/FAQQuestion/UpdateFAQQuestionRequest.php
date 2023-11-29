<?php


namespace App\Http\Requests\Backend\Web\FAQ\FAQQuestion;


use Illuminate\Foundation\Http\FormRequest;

class UpdateFAQQuestionRequest extends FormRequest
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
            'title' => 'required|max:255',
            'position' => 'numeric|nullable',
            'parent_id' => 'required|alpha_dash',
            'is_active' => 'required|numeric',
        ];
    }
}