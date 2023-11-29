<?php


namespace App\Http\Requests\Backend\Web\FileManager;


use Illuminate\Foundation\Http\FormRequest;

class StoreFileMangerRequest extends FormRequest
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
            'upload' => 'required|file|max:10240',
        ];
    }
}