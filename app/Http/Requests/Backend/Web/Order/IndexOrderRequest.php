<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 17:07
 */

namespace App\Http\Requests\Backend\Web\Order;

use Illuminate\Foundation\Http\FormRequest;

class IndexOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'string|nullable',
            'order_type_id' => 'string|nullable',
            'from_user_id' => 'string|nullable',
            'to_user_id' => 'string|nullable',
            'order_status_id' => 'string|nullable',
            'order_process_status_id' => 'string|nullable',
            'from_date_create' => 'date|nullable',
            'to_date_create' => 'date|nullable|after_or_equal:from_date_create',
            'from_date_update' => 'date|nullable',
            'to_date_update' => 'date|nullable|after_or_equal:from_date_update',
            'export' => 'string|nullable',
        ];
    }
}