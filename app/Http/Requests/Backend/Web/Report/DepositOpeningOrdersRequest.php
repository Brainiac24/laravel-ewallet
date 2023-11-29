<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 18.08.2021
 * Time: 19:34
 */

namespace App\Http\Requests\Backend\Web\Report;

use Illuminate\Foundation\Http\FormRequest;

class DepositOpeningOrdersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from_created_at' => 'date|nullable',
            'order_status_id' => 'string|nullable',
            'order_process_status_id' => 'string|nullable',
            'export' => 'string|nullable',
            'report_type_id' => 'string',
        ];
    }
}