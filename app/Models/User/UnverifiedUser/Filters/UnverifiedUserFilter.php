<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 30.08.2019
 * Time: 11:20
 */

namespace App\Models\User\UnverifiedUser\Filters;


use App\Services\Common\Filter\QueryFilter;

class UnverifiedUserFilter extends QueryFilter
{
    public function id($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('id like ?', ["%{$value}%"]);
        }
    }

//    public function smsCode($value)
//    {
//        if ($value === null) {
//            return $this->query;
//        } else {
//            return $this->query->whereRaw('sms_code like ?', ["%{$value}%"]);
//        }
//    }

    public function msisdn($value)
    {
        if ($value === null) {
            return $this->query;
        } else {
            return $this->query->whereRaw('msisdn like ?', ["%{$value}%"]);
        }
    }

//    public function devicesJson($value)
//    {
//        if ($value === null) {
//            return $this->query;
//        } else {
//            return $this->query->whereRaw('devices_json like ?', ["%{$value}%"]);
//        }
//    }
}