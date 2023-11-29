<?php

namespace App\Providers;

use App\Repositories\Frontend\Account\AccountEloquentRepository;
use App\Repositories\Frontend\Account\AccountHistory\AccountHistoryEloquentRepository;
use App\Repositories\Frontend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Repositories\Frontend\Account\AccountRepositoryContract;
use App\Repositories\Frontend\Account\AccountType\AccountTypeEloquentRepository;
use App\Repositories\Frontend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Frontend\Account\AccountTypeDetail\AccountTypeDetailEloquentRepository;
use App\Repositories\Frontend\Account\AccountTypeDetail\AccountTypeDetailRepositoryContract;
use App\Repositories\Frontend\Buglog\BuglogEloquentRepository;
use App\Repositories\Frontend\Buglog\BuglogRepositoryContract;
use App\Repositories\Frontend\CoordinatePoint\CoordinatePointEloquentRepository;
use App\Repositories\Frontend\CoordinatePoint\CoordinatePointRepositoryContract;
use App\Repositories\Frontend\Currency\CurrencyEloquentRepository;
use App\Repositories\Frontend\Currency\CurrencyRate\CurrencyRateEloquentRepository;
use App\Repositories\Frontend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Repositories\Frontend\Currency\CurrencyRateHistory\CurrencyRateHistoryEloquentRepository;
use App\Repositories\Frontend\Currency\CurrencyRateHistory\CurrencyRateHistoryRepositoryContract;
use App\Repositories\Frontend\Currency\CurrencyRepositoryContract;
use App\Repositories\Frontend\Favorite\FavoriteEloquentRepository;
use App\Repositories\Frontend\Favorite\FavoriteRepositoryContract;
use App\Repositories\Frontend\Gateway\GatewayEloquentRepository;
use App\Repositories\Frontend\Gateway\GatewayRepositoryContract;
use App\Repositories\Frontend\Service\Category\CategoryEloquentRepository;
use App\Repositories\Frontend\Service\Category\CategoryRepositoryContract;
use App\Repositories\Frontend\Service\Commission\CommissionEloquentRepository;
use App\Repositories\Frontend\Service\Commission\CommissionRepositoryContract;
use App\Repositories\Frontend\Service\ServiceEloquentRepository;
use App\Repositories\Frontend\Service\ServiceLimit\ServiceLimitEloquentRepository;
use App\Repositories\Frontend\Service\ServiceLimit\ServiceLimitRepositoryContract;
use App\Repositories\Frontend\Service\ServiceRepositoryContract;
use App\Repositories\Frontend\Service\Workday\WorkdayEloquentRepository;
use App\Repositories\Frontend\Service\Workday\WorkdayRepositoryContract;
use App\Repositories\Frontend\Setting\SettingEloquentRepository;
use App\Repositories\Frontend\Setting\SettingRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionEloquentRepository;
use App\Repositories\Frontend\Transaction\TransactionHistory\TransactionHistoryEloquentRepository;
use App\Repositories\Frontend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionStatus\TransactionStatusEloquentRepository;
use App\Repositories\Frontend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionStatusDetail\TransactionStatusDetailEloquentRepository;
use App\Repositories\Frontend\Transaction\TransactionStatusDetail\TransactionStatusDetailRepositoryContract;
use App\Repositories\Frontend\Transaction\TransactionType\TransactionTypeEloquentRepository;
use App\Repositories\Frontend\Transaction\TransactionType\TransactionTypeRepositoryContract;
use App\Repositories\Frontend\User\Attestation\AttestationEloquentRepository;
use App\Repositories\Frontend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Frontend\User\Event\EventEloquentRepository;
use App\Repositories\Frontend\User\Event\EventRepositoryContract;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserEloquentRepository;
use App\Repositories\Frontend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Frontend\User\UserEloquentRepository as FrontendUserRepository;
use App\Repositories\Frontend\User\UserRepositoryContract as FrontendUserRepositoryContract;
use App\Repositories\Frontend\User\UserServiceLimit\UserServiceLimitEloquentRepository;
use App\Repositories\Frontend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Repositories\Frontend\User\UserSession\UserSessionEloquentRepository;
use App\Repositories\Frontend\User\UserSession\UserSessionRepositoryContract;
use App\Services\Common\Gateway\Queue\QueueTransporter;
use App\Services\Common\Gateway\Queue\QueueTransporterContract;
use App\Services\Common\Image\ImageService;
use App\Services\Common\Image\ImageServiceContract;
use App\Services\Frontend\Api\Account\AccountService;
use App\Services\Frontend\Api\Account\AccountServiceContract;
use App\Services\Frontend\Api\Commission\CommissionService;
use App\Services\Frontend\Api\Commission\CommissionServiceContract;
use App\Services\Frontend\Api\Transaction\TransactionService;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use App\Services\Frontend\Api\User\UserServiceLimit\UserServiceLimitService;
use App\Services\Frontend\Api\User\UserServiceLimit\UserServiceLimitServiceContract;
use Illuminate\Support\ServiceProvider;


class FrontendBindingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindRepositories();
        $this->registerBindServices();
    }

    public function registerBindRepositories()
    {
        //binding repository
        $this->app->bind(CurrencyRepositoryContract::class, CurrencyEloquentRepository::class);
        $this->app->bind(CurrencyRateRepositoryContract::class, CurrencyRateEloquentRepository::class);
        $this->app->bind(CoordinatePointRepositoryContract::class, CoordinatePointEloquentRepository::class);
        $this->app->bind(CurrencyRateHistoryRepositoryContract::class, CurrencyRateHistoryEloquentRepository::class);
        $this->app->bind(GatewayRepositoryContract::class, GatewayEloquentRepository::class);
        $this->app->bind(AccountRepositoryContract::class, AccountEloquentRepository::class);
        $this->app->bind(AccountHistoryRepositoryContract::class, AccountHistoryEloquentRepository::class);
        $this->app->bind(AccountTypeDetailRepositoryContract::class, AccountTypeDetailEloquentRepository::class);
        $this->app->bind(AccountTypeRepositoryContract::class, AccountTypeEloquentRepository::class);
        $this->app->bind(FavoriteRepositoryContract::class, FavoriteEloquentRepository::class);
        $this->app->bind(ServiceRepositoryContract::class, ServiceEloquentRepository::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryEloquentRepository::class);
        $this->app->bind(CommissionRepositoryContract::class, CommissionEloquentRepository::class);
        
        $this->app->bind(ServiceLimitRepositoryContract::class, ServiceLimitEloquentRepository::class);
        $this->app->bind(WorkdayRepositoryContract::class, WorkdayEloquentRepository::class);
        $this->app->bind(TransactionRepositoryContract::class, TransactionEloquentRepository::class);
        $this->app->bind(TransactionHistoryRepositoryContract::class, TransactionHistoryEloquentRepository::class);
        $this->app->bind(TransactionStatusRepositoryContract::class, TransactionStatusEloquentRepository::class);
        $this->app->bind(TransactionStatusDetailRepositoryContract::class, TransactionStatusDetailEloquentRepository::class);
        $this->app->bind(TransactionTypeRepositoryContract::class, TransactionTypeEloquentRepository::class);
        $this->app->bind(SettingRepositoryContract::class, SettingEloquentRepository::class);
       
        $this->app->bind(AttestationRepositoryContract::class, AttestationEloquentRepository::class);
        $this->app->bind(UserServiceLimitRepositoryContract::class, UserServiceLimitEloquentRepository::class);
        $this->app->bind(EventRepositoryContract::class, EventEloquentRepository::class);

        $this->app->bind(UnverifiedUserRepositoryContract::class, UnverifiedUserEloquentRepository::class);
        $this->app->bind(FrontendUserRepositoryContract::class, FrontendUserRepository::class);
        $this->app->bind(UserSessionRepositoryContract::class, UserSessionEloquentRepository::class);
        $this->app->bind(BuglogRepositoryContract::class, BuglogEloquentRepository::class);

    }

    public function registerBindServices()
    {
        $this->app->bind(CommissionServiceContract::class, CommissionService::class);
        $this->app->bind(ImageServiceContract::class, ImageService::class);
        $this->app->bind(TransactionServiceContract::class, TransactionService::class);
        $this->app->bind(AccountServiceContract::class, AccountService::class);
        $this->app->bind(UserServiceLimitServiceContract::class, UserServiceLimitService::class);
    }
}
