<?php

namespace App\Http\Requests\Backend\Web\Order\RemoteIdentification;

use Illuminate\Foundation\Http\FormRequest;

class IndexRemoteIdentificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'payload_params_profile_fullname' => 'string|nullable',
            'processed_by_user_full_name' => 'string|nullable',
            'from_user_id' => 'numeric|nullable',
            'order_status_id' => 'string|nullable',
            'order_process_status_id' => 'string|nullable',
            'from_created_at' => 'date|nullable',
            'to_created_at' => 'date|nullable|after_or_equal:from_created_at',
            'from_updated_at' => 'date|nullable',
            'to_updated_at' => 'date|nullable|after_or_equal:from_updated_at',
            'from_user_attestation_id' => 'string|nullable',
            'payload_params_profile_inn' => 'string|nullable',
            'payload_params_profile_passport_seria' => 'string|nullable',
            'payload_params_profile_passport_number' => 'string|nullable',
        ];
    }
}