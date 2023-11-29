<?php

namespace App\Http\Requests\Backend\Web\Order\RemoteIdentification;

use Illuminate\Foundation\Http\FormRequest;

class RejectRemoteIdentificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile.status' => 'required',
            'profile.order_comment_id' => 'nullable|alpha_dash',
            'front_photo.status' => 'required',
            'front_photo.order_comment_id' => 'nullable|alpha_dash',
            'back_photo.status' => 'required',
            'back_photo.order_comment_id' => 'nullable|alpha_dash',
            'selfie_photo.status' => 'required',
            'selfie_photo.order_comment_id' => 'nullable|alpha_dash',
            'additional_photo.status' => 'nullable|string',
            'additional_photo.order_comment_id' => 'nullable|alpha_dash',
            'additional_photo.include' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'profile.status.required' => '"Анкетные данные совпадают с паспортными данными из фото?", выберите значение «Да» или «Нет»',
            'front_photo.status.required' => 'Необходимо оценить качество фотографии "Лицевая сторона паспорта", выберите значение «Да» или «Нет», который находиться внизу фотографии',
            'back_photo.status.required' => 'Необходимо оценить качество фотографии "Оборотная сторона паспорта", выберите значение «Да» или «Нет», который находиться внизу фотографии',
            'selfie_photo.status.required' => 'Необходимо оценить качество фотографии "Фото с паспортом(селфи)", выберите значение «Да» или «Нет», который находиться внизу фотографии',
        ];
    }
}