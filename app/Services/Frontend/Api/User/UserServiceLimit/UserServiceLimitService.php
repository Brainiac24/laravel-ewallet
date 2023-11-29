<?php

namespace App\Services\Frontend\Api\User\UserServiceLimit;

use App\Exceptions\Frontend\Api\LimitException;
use App\Models\User\UserServiceLimit\UserServiceLimit;
use App\Repositories\Frontend\User\UserRepositoryContract;
use App\Repositories\Frontend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Services\Frontend\Api\User\UserServiceLimit\UserServiceLimitServiceContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserServiceLimitService implements UserServiceLimitServiceContract
{
    protected $userServiceLimitRepository;
    protected $userRepository;

    public function __construct(UserServiceLimitRepositoryContract $userServiceLimitRepository, UserRepositoryContract $userRepository)
    {
        $this->userServiceLimitRepository = $userServiceLimitRepository;
        $this->userRepository = $userRepository;
    }

    public function calculateLimits($service, $amount, $save = false)
    {
        $userServiceLimit = $this->userServiceLimitRepository->findByServiceId($service->id);
        if ($service->service_limit != null) {
            if ($userServiceLimit == null) {
                $userServiceLimit = new UserServiceLimit();
                $userServiceLimit->service_id = $service->id;
                $userServiceLimit->user_id = Auth::user()->id;
                $limits = $service->service_limit->params_json;

                //ХАРДКОД - необходимо генерировать шаблон из таблицы service_limits
                $limits['day']['limit'] = 0;
                $limits['day']['updated_at'] = '2000-01-01 00:00:00';
                $limits['week']['limit'] = 0;
                $limits['week']['updated_at'] = '2000-01-01 00:00:00';
                $limits['month']['limit'] = 0;
                $limits['month']['updated_at'] = '2000-01-01 00:00:00';
                $userServiceLimit->params_json = $this->Limits($limits, $amount, $service->service_limit->params_json);
            } else {
                //dd($userServiceLimit->params_json);
                $userServiceLimit->params_json = $this->Limits($userServiceLimit->params_json, $amount, $service->service_limit->params_json);
            }
            
            if($save){
                $userServiceLimit->save();
            }
            
        }

        
    }

    public function Limits($limits, $amount, $limitsTemplate)
    {
        $carbon = new Carbon();
        
        if ($limits != null) {

            foreach ($limits as $key => &$value) {
                switch ($key) {
                    case 'day':
                        if ($carbon->parse($value['updated_at'])->toDateString() < $carbon->now()->toDateString()) {
                            if (((double) $amount) <= ((double) $limitsTemplate['day']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.day_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_DAY_LIMIT_IS_REACHED]);
                            }
                        } else {
                            if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $limitsTemplate['day']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.day_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_DAY_LIMIT_IS_REACHED]);
                            }
                        }

                        break;
                    case 'week':
                        if ($carbon->parse($value['updated_at'])->weekOfYear < $carbon->now()->weekOfYear) {
                            if (((double) $amount) <= ((double) $limitsTemplate['week']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.week_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_WEEK_LIMIT_IS_REACHED]);
                            }
                        } else {
                            if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $limitsTemplate['week']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.week_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_WEEK_LIMIT_IS_REACHED]);
                            }
                        }

                        break;
                    case 'month':
                    
                        if ($carbon->parse($value['updated_at'])->month < $carbon->now()->month) {
                            if (((double) $amount) <= ((double) $limitsTemplate['month']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.month_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_MONTH_LIMIT_IS_REACHED]);
                            }
                        } else {
                            if ((((double) $value['limit']) + ((double) $amount)) <= ((double) $limitsTemplate['month']['limit'])) {
                                $value['updated_at'] = $carbon->now()->toDateTimeString();
                                $value['limit'] = ((double) $value['limit']) + ((double) $amount);
                            } else {
                                throw (new LimitException(trans('UserServiceLimit.errors.month_limit_is_reached')))->setAttribute(['error_code'=> self::ERROR_MONTH_LIMIT_IS_REACHED]);
                            }
                        }
                        break;
                    default:
                }
            }

        }
        return $limits;
    }

}
