<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 01.08.2019
 * Time: 15:47
 */

namespace App\Models\Order\Filters;


use App\Services\Common\Filter\QueryFilter;

class OrderFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

    public function fromUserId($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('from_user', function ($q) use ($value) {
                $q->whereRaw('msisdn like ? ', ["%{$value}%"]);
            });
        }
    }

    public function toUserId($value)
    {
        if (!empty($value)) {
            return $this->query->whereHas('to_user', function ($q) use ($value) {
                $q->whereRaw('msisdn like ? ', ["%{$value}%"]);
            });
        }
    }

    public function orderTypeId($value)
    {
        if (!empty($value)) {
            return $this->query->where('order_type_id', $value);
        }
    }

    public function fromUserFullName($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereHas('from_user', function ($q) use ($value) {
                $q->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
            });

        }
    }

    public function fromCreatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toCreatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }
    public function fromUpdatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('updated_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toUpdatedAt($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('updated_at', '<=', "{$value} 23:59:59");
        }
    }

    public function orderStatusId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('order_status_id', $value);
        }
    }

    public function orderProcessStatusId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('order_process_status_id', $value);
        }
    }

    public function fromUserAttestationId($value)
    {
        if ($value === null) {
            return $this->query;
        } else {

            return $this->query->whereHas('from_user', function ($q) use ($value) {
                $q->where('attestation_id', $value);
            });

        }
    }

    public function payloadParamsProfileInn($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw("`payload_params_json` LIKE ?",['%{"key":"inn","value":"%'.$value.'%"}%']);
        }
    }

    public function payloadParamsProfilePassportSeria($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw("`payload_params_json` LIKE ?",['%{"key":"passport_seria","value":"'.$value.'"}%']);
        }
    }


    public function payloadParamsProfilePassportNumber($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw("`payload_params_json` LIKE ?",['%{"key":"passport_number","value":"%'.$value.'%"}%']);
        }
    }

    public function payloadParamsProfileFullname($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw("CONCAT(
                                                  JSON_UNQUOTE (
                                                    JSON_EXTRACT (
                                                      payload_params_json,
                                                      \"$.profile.Items[1].value\"
                                                    )
                                                  ),
                                                  ' ',
                                                  JSON_UNQUOTE (
                                                    JSON_EXTRACT (
                                                      payload_params_json,
                                                      \"$.profile.Items[0].value\"
                                                    )
                                                  ),
                                                  ' ',
                                                  JSON_UNQUOTE (
                                                    JSON_EXTRACT (
                                                      payload_params_json,
                                                      \"$.profile.Items[2].value\"
                                                    )
                                                  )) LIKE ?", ["%{$value}%"]);

        }
    }

    public function processedByUserFullName($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereHas('processed_by_user', function ($q) use ($value) {
                $q->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
            });
        }
    }


    public function fromDateCreate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toDateCreate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }


    public function fromDateUpdate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('updated_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toDateUpdate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('updated_at', '<=', "{$value} 23:59:59");
        }
    }
}