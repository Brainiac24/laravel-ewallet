<?php

namespace App\Providers;

use Carbon\Carbon;
use Cron\CronExpression;
use Hash;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('msisdn', function ($attribute, $value, $parameters, $validator) {
            return strlen($value) == 12;
        });


        \Validator::extend('valid_date_range_diff_in_day_if', function ($attribute, $value, $parameters, $validator) {
            if(isset($validator->getData()[$parameters[2]])) {
                $dateBeginning = Carbon::createFromFormat('Y-m-d', $validator->getData()[$parameters[0]]); // do confirm the date format.
                $dateEnd = Carbon::createFromFormat('Y-m-d', $value);
                return $dateBeginning->diffInDays($dateEnd) <= $parameters[1];
            }

            return true;
        });

        \Validator::replacer('valid_date_range_diff_in_day_if', function ($message, $attribute, $rule, $parameters) {
            return "Диапазон даты должно быть не более 31 дней $attribute - $parameters[0]";
        });

        \Validator::extend('current_password_match', function($attribute, $value, $parameters, $validator){
            return Hash::check($value, \Auth::user()->password);
        });

        \Validator::replacer('current_password_match', function ($message, $attribute, $rule, $parameters) {
            return "Текущий пароль не правильный!";
        });

        \Validator::extend('cron', function ($attribute, $value, $parameters, $validator) {
            return CronExpression::isValidExpression($value);
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
