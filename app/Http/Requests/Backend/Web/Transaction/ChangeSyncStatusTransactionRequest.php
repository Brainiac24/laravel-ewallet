<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 19.11.2019
 * Time: 14:40
 */

namespace App\Http\Requests\Backend\Web\Transaction;


use Illuminate\Foundation\Http\FormRequest;

class ChangeSyncStatusTransactionRequest extends FormRequest
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
        return [
            'transaction_sync_status_id' => 'required|alpha_dash',
        ];
    }
}