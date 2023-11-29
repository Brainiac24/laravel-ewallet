<?php

namespace App\Http\Requests\Backend\Web\SplashScreen;

use Illuminate\Foundation\Http\FormRequest;

class StoreSplashScreenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'icon' => 'required_if:icon_file,'.(null).'|nullable|string',
            'icon_file' => 'required_if:icon,'.(null).'|image|max:2048|nullable',
        ];
    }
}