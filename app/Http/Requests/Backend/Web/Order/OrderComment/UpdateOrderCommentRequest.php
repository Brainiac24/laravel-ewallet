<?php
namespace App\Http\Requests\Backend\Web\Order\OrderComment;

use App\Services\Common\Helpers\OrderType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'short_name' => 'required|string',
            'name' => 'required|string',
            'order_type_id' => 'required|alpha_dash',
            'is_active' => 'required|numeric',
            'code' => 'required_if:order_type_id,'.OrderType::REMOTE_IDENTIFICATION.'|string|max:191|nullable',
        ];
    }
}