<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 23.01.2020
 * Time: 16:30
 */

namespace App\Http\Requests\Backend\Web\Order;


use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
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
        //dd($this->comment);
        return [
            'order_process_status_id' => 'required|alpha_dash',
            'send_to_processing' => 'alpha_dash',
            'is_queued' => 'alpha_dash'
        ];
    }
}