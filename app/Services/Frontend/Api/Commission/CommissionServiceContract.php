<?php

namespace App\Services\Frontend\Api\Commission;

interface CommissionServiceContract
{

    const ERROR_COMMISSION_DOES_NOT_MATCH = 'error_commission_does_not_match';

    public function calculateCommission($service, $amount, $commissionFromClient);

    public function checkCommissionFromClient($comm, $commissionFromClient);
}