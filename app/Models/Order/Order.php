<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 15:27
 */

namespace App\Models\Order;


use App\Models\BaseModel;
use App\Models\Order\OrderProcessStatus\OrderProcessStatus;
use App\Models\Order\OrderTypes\OrderTypes;
use App\Models\User\User;
use App\Models\Order\OrderStatus\OrderStatus;
use App\Services\Common\Filter\Filterable;
use Carbon\Carbon;

class Order extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'order_type_id',
        'number',
        'from_user_id',
        'to_user_id',
        'entity_type',
        'entity_id',
        'payload_params_json',
        'order_status_id',
        'order_process_status_id',
        'is_queued',
        'response',
        'processed_by_user_id',
        'updated_by_user_id'
    ];

    protected $casts = [
        'payload_params_json' => 'array',
        'response' => 'array',
    ];

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }

    public function order_type()
    {
        return $this->belongsTo(OrderTypes::class,'order_type_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'order_status_id');
    }

    public function order_process_status()
    {
        return $this->belongsTo(OrderProcessStatus::class,'order_process_status_id');
    }

    //scopes
    public function scopeIsRemoteIdentification($q)
    {
        return $q->where('order_type_id', config("app_settings.order_types_remote_identification"));
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class,'updated_by_user_id');
    }

    public function processed_by_user()
    {
        return $this->belongsTo(User::class,'processed_by_user_id');
    }

    public function getRemoteIdentificationPayloadParamsAttribute()
    {
        $data = $this->payload_params_json;
        if(isset($data["profile"]["Items"] )) {
            $profileItems = [];
            foreach ($data["profile"]["Items"] as $item) {
                if(!is_null($item["value"]) && !empty($item["value"]) && in_array($item["key"],array("birth_date","passport_issue_date","document_expiration_date", "registration_date"))){
                    $item["value"] = Carbon::createFromFormat("d.m.Y", $item["value"])->format("Y-m-d");
                }
                $profileItems[$item["key"]] = $item["value"];
            }
            $profileItems["full_name"] = $profileItems["last_name"]." ".$profileItems["first_name"]." ".$profileItems["middle_name"];
            $data["profile"]["Items"] = $profileItems;
        }

        return $data;
    }

    public function getInformationAttribute()
    {
        if ($this->remote_identification_payload_params["selfie_photo"]["status"] == "REJECTED" ||
            $this->remote_identification_payload_params["back_photo"]["status"] == "REJECTED" ||
            $this->remote_identification_payload_params["front_photo"]["status"] == "REJECTED" ||
            (isset($this->remote_identification_payload_params["additional_photo"]) &&
                $this->remote_identification_payload_params["additional_photo"]["status"] == "REJECTED")
        ){
            return "Низкое качество фото";
        }
        return "";
    }
}