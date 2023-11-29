<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 25.09.2018
 * Time: 14:29
 */

namespace App\Models\User\Filters;


use App\Services\Common\Filter\QueryFilter;

class ClientFilter extends QueryFilter
{
    public function fullName($value)
    {
        return $this->query->whereRaw("CONCAT_WS(' ', last_name, first_name, middle_name) LIKE ?", ["%{$value}%"]);
    }
    public function msisdn($value)
    {
        return $this->query->whereRaw('CAST(msisdn as CHAR(12)) LIKE ?', ["%{$value}%"]);
    }

    public function codeMap($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('code_map like ?', ["%{$value}%"]);
        }
    }

    public function attestationId($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('attestation_id', '=', $value);
        }
    }

    public function fromDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '>=', "{$value} 00:00:00");
        }
    }

    public function toDate($value)
    {
        if ($value == null) {
            return $this->query;
        } else {
            return $this->query->where('created_at', '<=', "{$value} 23:59:59");
        }
    }

    public function devicesJson($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('devices_json like ?', ["%{$value}%"]);
        }
    }
}