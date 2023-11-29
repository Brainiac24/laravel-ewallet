<?php

namespace App\Services\Frontend\Api\Commission;

use App\Exceptions\Frontend\Api\ValidationException;
use App\Repositories\Frontend\Service\Commission\CommissionRepositoryContract;
use App\Services\Frontend\Api\Commission\CommissionServiceContract;

class CommissionService implements CommissionServiceContract
{
    protected $commissionRepository;

    public function __construct(CommissionRepositoryContract $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function calculateCommission($service, $amount, $commissionFromClient)
    {
        $comm = 0;
        if ($service->commission != null) {
            foreach ($service->commission->params_json as $param) {
                if ((((double) $amount) >= ((double) $param['min'])) && (((double) $amount) < ((double) $param['max']))) {
                    if (isset($param['is_percentage'])) {
                        if ($param['is_percentage'] == 1) {
                            $comm = ((double) $amount) * ((((double) $param['value']) / 100));
                            $this->checkCommissionFromClient($comm, $commissionFromClient);
                            break;
                        } else {
                            $comm = ((double) $param['value']);
                            $this->checkCommissionFromClient($comm, $commissionFromClient);
                            break;
                        }
                    } else {
                        $comm = ((double) $param['value']);
                        $this->checkCommissionFromClient($comm, $commissionFromClient);
                        break;
                    }
                }
            }
        }
        return $comm;
    }

    public function checkCommissionFromClient($comm, $commissionFromClient)
    {
        //dd(round(($comm), 4));
        if (round(($comm), 2) != $commissionFromClient) {
            throw (new ValidationException(trans('service.errors.commission_does_not_match')))->setAttribute(['error_code'=> self::ERROR_COMMISSION_DOES_NOT_MATCH]);
        }
    }

}
