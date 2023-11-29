<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 19.07.2018
 * Time: 14:00
 */

namespace App\Services\Frontend\Api\User\UserServiceLimit;

interface UserServiceLimitServiceContract
{
    const ERROR_DAY_LIMIT_IS_REACHED = 'error_day_limit_is_reached';
    const ERROR_WEEK_LIMIT_IS_REACHED = 'error_week_limit_is_reached';
    const ERROR_MONTH_LIMIT_IS_REACHED = 'error_month_limit_is_reached';

    public function calculateLimits($service, $amount);

    public function Limits($limits, $amount, $limitsTemplate);
}