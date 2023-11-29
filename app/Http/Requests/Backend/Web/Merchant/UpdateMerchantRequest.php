<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 13:31
 */

namespace App\Http\Requests\Backend\Web\Merchant;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMerchantRequest extends FormRequest
{
    use ReportLastDateRuleTrait;
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
        //dd($this->parent_id);

        return [
            'name' => 'required|max:255',
            'organization' => 'required|max:255',
            // Отключён по причини избежание лишних проблем, например при изменении account_number
            // также надо будет учитывать изменении account_number в таблице merchant_items
            'account_number' => 'required|max:50',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'email' => 'required_if:generate_report,1|max:255',
            'city_id' => 'required|alpha_dash',
            //'merchant_category_id' => 'alpha_dash',
            'merchant_category_ids' => 'required|array|min:1',
            'merchant_category_ids.*' => 'required|alpha_dash|min:1',
            'merchant_workday_id' => 'alpha_dash|nullable',
            'inn' => 'required|max:255',
            'img_logo' => 'image|max:2048|nullable',
            'img_ad' => 'image|max:2048|nullable',
            'img_detail' => 'image|max:2048|nullable',
            'desc' => 'string|nullable',
            'merchant_cashback_id' => 'alpha_dash|nullable',
            'bank_cashback_id' => 'alpha_dash|nullable',
            'bank_id' => 'alpha_dash|nullable',
            'branch_id' => 'alpha_dash|nullable',
            'merchant_commission_id' => 'alpha_dash|nullable',
            'latitude' => 'string|nullable',
            'is_qr_integrated' => 'alpha_dash',
            'longtitude' => 'string|nullable',
            'position' => 'numeric|nullable',
            //'user_count' => 'numeric|nullable',
            'highest_cashback_value' => 'numeric|nullable',
            'generate_report' => 'alpha_dash',
            'params_json.report.is_send_to_merchant' => 'required_if:generate_report,1|alpha_dash',
            'params_json.report.is_send_to_all_merchant_item' => 'required_if:generate_report,1|alpha_dash',
            'params_json.report.interval' => 'required_if:generate_report,1|numeric',
            'params_json.report.last_send' => 'nullable|required_if:generate_report,1|'.$this->isValidDate(),
            'params_json.report.period' => 'required_if:generate_report,1|string',
            'params_json.report.merchant_items' => 'nullable|array',
            'params_json.report.merchant_items.*' => 'nullable|alpha_dash',
            'is_active' => 'alpha_dash',
            'is_verified' => 'alpha_dash',
            'webhook_url' => 'url|nullable',
            'merchant_cashback_start_date' => 'date_format:Y-m-d\TH:i|nullable',
            'merchant_cashback_end_date' => 'date_format:Y-m-d\TH:i|after:merchant_cashback_start_date|nullable|required_with_all:merchant_cashback_start_date',
            'bank_cashback_start_date' => 'date_format:Y-m-d\TH:i|nullable',
            'bank_cashback_end_date' => 'date_format:Y-m-d\TH:i|after:bank_cashback_start_date|nullable|required_with_all:bank_cashback_start_date',
            'params_json.referral' => 'nullable|string',
            'contract_file' => 'max:5120|nullable|mimes:pdf',
        ];
    }
}