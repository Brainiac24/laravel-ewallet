<?php

namespace App\Providers;

use App\Events\Backend\Cashback\CashbackItem\CashbackItemModifiedEvent;
use App\Events\Backend\Cashback\CashbackModifiedEvent;
use App\Events\Backend\CoordinatePoint\CoordinatePointModifiedEvent;
use App\Events\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeModifiedEvent;
use App\Events\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayModifiedEvent;
use App\Events\Backend\Currency\CurrencRate\CurrencyRateModified;
use App\Events\Backend\Merchant\MerchantModifiedEvent;
use App\Events\Backend\Merchant\MerchantWorkday\MerchantWorkdayModifiedEvent;
use App\Events\Backend\User\UserChangePassword\UserChangePasswordEvent;
use App\Events\Frontend\User\UserAuthenticatedWithPinEvent;
use App\Events\Frontend\User\UserChangedPinEvent;
use App\Events\Frontend\User\UserLogoutEvent;
use App\Events\Frontend\User\UserRefreshedTokenEvent;
use App\Events\Frontend\User\UserRegisteredEmailEvent;
use App\Events\Frontend\User\UserRegisteredPhoneEvent;
use App\Events\Frontend\User\UserRegisteredWithPinEvent;
use App\Events\Frontend\User\UserRegisteringEmailEvent;
use App\Events\Frontend\User\UserRegisteringPhoneEvent;
use App\Events\Frontend\User\UserResetPinEvent;
use App\Events\Frontend\User\UserResettingConfirmedPinEvent;
use App\Events\Frontend\User\UserResettingPinEvent;
use App\Listeners\Backend\Cashback\CashbackItem\CashbackItemModifiedListener;
use App\Listeners\Backend\Cashback\CashbackModifiedListener;
use App\Listeners\Backend\CoordinatePoint\CoordinatePointModifiedListener;
use App\Listeners\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeModifiedListener;
use App\Listeners\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayModifiedListener;
use App\Listeners\Backend\Currency\CurrencyRateHistory\SaveCurrencyHistoryListener;
use App\Listeners\Backend\Merchant\MerchantModifiedListener;
use App\Listeners\Backend\Merchant\MerchantWorkday\MerchantWorkdayModifiedListener;
use App\Listeners\Backend\User\UserChangePassword\UserChangePasswordListener;
use App\Listeners\Backend\User\UserSuccessfullLogin;
use App\Listeners\Frontend\User\UserHistory\UserModifiedListener;
use App\Listeners\Frontend\User\UserSession\SaveTokenListener;
use App\Listeners\Frontend\User\UserUpdateLastLoginAtListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        'Illuminate\Auth\Events\Login' => [
            UserSuccessfullLogin::class,
        ],

        UserRegisteringPhoneEvent::class => [
            UserModifiedListener::class,
        ],
        UserRegisteredPhoneEvent::class => [
            UserModifiedListener::class,
        ],
        UserRegisteredWithPinEvent::class => [
            SaveTokenListener::class,
            UserModifiedListener::class,
        ],
        UserAuthenticatedWithPinEvent::class => [
            SaveTokenListener::class,
            UserModifiedListener::class,
            UserUpdateLastLoginAtListener::class,
        ],
        UserChangedPinEvent::class => [
            UserModifiedListener::class,
        ],
        UserRegisteringEmailEvent::class => [
            UserModifiedListener::class,
        ],
        UserRegisteredEmailEvent::class => [
            UserModifiedListener::class,
        ],
        UserRefreshedTokenEvent::class => [
            SaveTokenListener::class,
            UserModifiedListener::class,
            UserUpdateLastLoginAtListener::class,
        ],
        UserResettingPinEvent::class => [
            UserModifiedListener::class,
        ],
        UserResettingConfirmedPinEvent::class => [
            UserModifiedListener::class,
        ],
        UserResetPinEvent::class => [
            SaveTokenListener::class,
            UserModifiedListener::class,
        ],
        UserLogoutEvent::class => [
            UserModifiedListener::class,
        ],

        'App\Events\Frontend\User\UserHistory\UserModifiedEvent' => [
            'App\Listeners\Frontend\User\UserHistory\UserModifiedListener',
        ],
        'App\Events\Backend\User\UserHistory\UserModifiedForSettingEvent' => [
            'App\Listeners\Backend\User\UserHistory\UserModifiedForSettingListener',
        ],
        'App\Events\Backend\User\UserHistory\UserModifiedEvent' => [
            'App\Listeners\Backend\User\UserHistory\UserModifiedListener',
        ],
        'App\Events\Frontend\Account\AccountHistory\AccountModifiedEvent' => [
            'App\Listeners\Frontend\Account\AccountHistory\AccountModifiedListener',
        ],
        'App\Events\Frontend\Transaction\TransactionHistory\TransactionModifiedEvent' => [
            'App\Listeners\Frontend\Transaction\TransactionHistory\TransactionModifiedListener'
        ],
        CurrencyRateModified::class => [
            SaveCurrencyHistoryListener::class,
        ],

        UserChangePasswordEvent::class => [
            UserChangePasswordListener::class,
        ],

        CashbackItemModifiedEvent::class => [
            CashbackItemModifiedListener::class,
        ],

        CashbackModifiedEvent::class => [
            CashbackModifiedListener::class,
        ],

        CoordinatePointModifiedEvent::class => [
            CoordinatePointModifiedListener::class,
        ],

        CoordinatePointTypeModifiedEvent::class => [
            CoordinatePointTypeModifiedListener::class,
        ],

        CoordinatePointWorkdayModifiedEvent::class => [
            CoordinatePointWorkdayModifiedListener::class,
        ],

        MerchantModifiedEvent::class => [
            MerchantModifiedListener::class,
        ],

        MerchantWorkdayModifiedEvent::class => [
            MerchantWorkdayModifiedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
