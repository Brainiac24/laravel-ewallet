<?php

namespace App\Providers;



use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualEloquentRepository;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualRepositoryContract;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatusEloquentRepository;
use App\Repositories\Backend\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatusRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackType\CashbackTypeEloquentRepository;
use App\Repositories\Backend\Cashback\CashbackType\CashbackTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityEloquentRepository;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointCity\CoordinatePointCityRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointService\CoordinatePointServiceEloquentRepository;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointService\CoordinatePointServiceRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeEloquentRepository;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointType\CoordinatePointTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService\CoordinatePointTypeServiceEloquentContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointTypeService\CoordinatePointTypeServiceRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayEloquentRepository;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkdayRepositoryContract;
use App\Repositories\Backend\DwhRule\DwhRuleEloquentRepository;
use App\Repositories\Backend\DwhRule\DwhRuleRepositoryContract;
use App\Repositories\Backend\FAQ\FAQAnswer\FAQAnswerEloquentRepository;
use App\Repositories\Backend\FAQ\FAQAnswer\FAQAnswerRepositoryContract;
use App\Repositories\Backend\FAQ\FAQQuestion\FAQQuestionEloquentRepository;
use App\Repositories\Backend\FAQ\FAQQuestion\FAQQuestionRepositoryContract;
use App\Repositories\Backend\Job\JobHistory\JobHistoryEloquentRepository;
use App\Repositories\Backend\Job\JobHistory\JobHistoryRepositoryContract;
use App\Repositories\Backend\JobLog\JobLogDwhEloquentRepository;
use App\Repositories\Backend\JobLog\JobLogDwhRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantUser\MerchantUserEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantUser\MerchantUserRepositoryContract;
use App\Repositories\Backend\Order\OrderComment\OrderCommentEloquentRepository;
use App\Repositories\Backend\Order\OrderComment\OrderCommentRepositoryContract;
use App\Repositories\Backend\JobLog\JobLogArchiveEloquentRepository;
use App\Repositories\Backend\JobLog\JobLogArchiveRepositoryContract;
use App\Repositories\Backend\Order\RemoteIdentification\RemoteIdentificationEloquentRepository;
use App\Repositories\Backend\Order\RemoteIdentification\RemoteIdentificationRepositoryContract;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeEloquentRepository;
use App\Repositories\Backend\OrderCardContractType\OrderCardContractTypeRepositoryContract;
use App\Repositories\Backend\ReportAnalysis\ReportAnalysisEloquentRepository;
use App\Repositories\Backend\ReportAnalysis\ReportAnalysisRepositoryContract;
use App\Repositories\Backend\ReportType\ReportTypeEloquentRepository;
use App\Repositories\Backend\ReportType\ReportTypeRepositoryContract;

use App\Repositories\Backend\SplashScreen\SplashScreenEloquentRepository;
use App\Repositories\Backend\SplashScreen\SplashScreenRepositoryContract;
use App\Repositories\Backend\Schedule\ScheduleEloquentRepository;
use App\Repositories\Backend\Schedule\ScheduleJob\ScheduleJobEloquentRepository;
use App\Repositories\Backend\Schedule\ScheduleJob\ScheduleJobRepositoryContract;
use App\Repositories\Backend\Schedule\ScheduleRepositoryContract;
use App\Repositories\Backend\Schedule\ScheduleType\ScheduleTypeEloquentRepository;
use App\Repositories\Backend\Schedule\ScheduleType\ScheduleTypeRepositoryContract;

use App\Repositories\Backend\Transaction\TransactionContinueRule\TransactionContinueRuleEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionContinueRule\TransactionContinueRuleRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordanceEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionContinueRuleAccordance\TransactionContinueRuleAccordanceRepositoryContract;

use App\Repositories\Backend\Transaction\TransactionHistoryDwh\TransactionHistoryDwhEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionHistoryDwh\TransactionHistoryDwhRepositoryContract;
use App\Repositories\Backend\User\UserHistory\UserHistoryEloquentRepository;
use App\Repositories\Backend\User\UserHistoryDwh\UserHistoryDwhRepositoryContract;
use App\Services\Backend\Web\DwgRule\DwhRuleService;
use App\Services\Backend\Web\DwgRule\DwhRuleServiceContract;
use App\Services\Backend\Web\ExportJob\BeetweenEwalletEskhataTransactionsExportJob\BeetweenEwalletEskhataTransactionsExportJobService;
use App\Services\Backend\Web\ExportJob\BeetweenEwalletEskhataTransactionsExportJob\BeetweenEwalletEskhataTransactionsExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\DepositOpeningOrders\DepositOpeningOrdersService;
use App\Services\Backend\Web\ExportJob\DepositOpeningOrders\DepositOpeningOrdersServiceContract;
use App\Services\Backend\Web\ExportJob\KortiMilliTransactionExportJob\KortiMilliTransactionExportJobService;
use App\Services\Backend\Web\ExportJob\KortiMilliTransactionExportJob\KortiMilliTransactionExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\MerchantQrTransactionsExportJob\MerchantQrTransactionsExportJobService;
use App\Services\Backend\Web\ExportJob\MerchantQrTransactionsExportJob\MerchantQrTransactionsExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\OrderExportJob\OrderExportJobService;
use App\Services\Backend\Web\ExportJob\OrderExportJob\OrderExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\RemoteIdentificationExportJob\RemoteIdentificationExportJobService;
use App\Services\Backend\Web\ExportJob\RemoteIdentificationExportJob\RemoteIdentificationExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\ReplenishmentEwalletEskhataTransactionsExportJob\ReplenishmentEwalletEskhataTransactionsExportJobService;
use App\Services\Backend\Web\ExportJob\ReplenishmentEwalletEskhataTransactionsExportJob\ReplenishmentEwalletEskhataTransactionsExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\TransactionAnalysisEwalletEskhataExportJob\TransactionAnalysisEwalletEskhataExportJobService;
use App\Services\Backend\Web\ExportJob\TransactionAnalysisEwalletEskhataExportJob\TransactionAnalysisEwalletEskhataExportJobServiceContract;
use App\Services\Backend\Web\JobLog\JobLogDwhService;
use App\Services\Backend\Web\JobLog\JobLogDwhServiceContract;
use App\Services\Backend\Web\JobLog\JobLogService;
use App\Services\Backend\Web\JobLog\JobLogServiceContract;
use App\Services\Backend\Web\Merchant\MerchantService;
use App\Services\Backend\Web\Merchant\MerchantServiceContract;
use App\Services\Backend\Web\ExportJob\ClientExportJob\ClientExportJobService;
use App\Services\Backend\Web\ExportJob\ClientExportJob\ClientExportJobServiceContract;
use App\Services\Backend\Web\ExportJob\MerchantExportJob\MerchantExportJobService;
use App\Services\Backend\Web\ExportJob\MerchantExportJob\MerchantExportJobServiceContract;
use App\Services\Backend\Web\Order\RemoteIdentification\RemoteIdentificationService;
use App\Services\Backend\Web\Order\RemoteIdentification\RemoteIdentificationServiceContract;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobService;
use App\Services\Backend\Web\ExportJob\TransactionExportJob\TransactionExportJobServiceContract;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryDwhService;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryDwhServiceContract;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryService;
use App\Services\Backend\Web\TransactionHistory\TransactionHistoryServiceContract;
use App\Services\Backend\Web\UserHistory\UserHistoryDwhService;
use App\Services\Backend\Web\UserHistory\UserHistoryDwhServiceContract;
use App\Services\Backend\Web\UserHistory\UserHistoryService;
use App\Services\Backend\Web\UserHistory\UserHistoryServiceContract;
use Illuminate\Support\ServiceProvider;
use App\Services\Backend\Api\User\UserService;
use App\Services\Backend\Api\User\UserServiceContract;
use App\Repositories\Backend\Area\AreaEloquentRepository;
use App\Repositories\Backend\Area\AreaRepositoryContract;
use App\Repositories\Backend\Bank\BankEloquentRepository;
use App\Repositories\Backend\Bank\BankRepositoryContract;
use App\Repositories\Backend\City\CityEloquentRepository;
use App\Repositories\Backend\City\CityRepositoryContract;
use App\Repositories\Backend\News\NewsEloquentRepository;
use App\Repositories\Backend\News\NewsRepositoryContract;
use App\Repositories\Backend\User\UserEloquentRepository;
use App\Repositories\Backend\User\UserRepositoryContract;
use App\Repositories\Backend\Color\ColorEloquentRepository;
use App\Repositories\Backend\Color\ColorRepositoryContract;
use App\Repositories\Backend\Order\OrderEloquentRepository;
use App\Repositories\Backend\Order\OrderRepositoryContract;
use App\Services\Backend\Api\Transaction\TransactionService;
use App\Repositories\Backend\JobLog\JobLogEloquentRepository;
use App\Repositories\Backend\JobLog\JobLogRepositoryContract;
use App\Repositories\Backend\Region\RegionEloquentRepository;
use App\Repositories\Backend\Region\RegionRepositoryContract;
use App\Repositories\Backend\User\Role\RoleEloquentRepository;
use App\Repositories\Backend\User\Role\RoleRepositoryContract;
use App\Services\Backend\Web\Notification\NotificationService;
use App\Repositories\Backend\Account\AccountEloquentRepository;
use App\Repositories\Backend\Account\AccountRepositoryContract;
use App\Repositories\Backend\Country\CountryEloquentRepository;
use App\Repositories\Backend\Country\CountryRepositoryContract;
use App\Repositories\Backend\Gateway\GatewayEloquentRepository;
use App\Repositories\Backend\Gateway\GatewayRepositoryContract;
use App\Repositories\Backend\Purpose\PurposeEloquentRepository;
use App\Repositories\Backend\Purpose\PurposeRepositoryContract;
use App\Repositories\Backend\Service\ServiceEloquentRepository;
use App\Repositories\Backend\Service\ServiceRepositoryContract;
use App\Repositories\Backend\Setting\SettingEloquentRepository;
use App\Repositories\Backend\Setting\SettingRepositoryContract;
use App\Services\Common\Gateway\Processing\ProcessingTransport;
use App\Repositories\Backend\User\Event\EventEloquentRepository;
use App\Repositories\Backend\User\Event\EventRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackEloquentRepository;
use App\Repositories\Backend\Cashback\CashbackRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyEloquentRepository;
use App\Repositories\Backend\Currency\CurrencyRepositoryContract;
use App\Repositories\Backend\Favorite\FavoriteEloquentRepository;
use App\Repositories\Backend\Favorite\FavoriteRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantRepositoryContract;
use App\Repositories\Backend\User\Client\ClientEloquentRepository;
use App\Repositories\Backend\User\Client\ClientRepositoryContract;
use App\Services\Common\Gateway\Consolidator\ConsolidatorContract;
use App\Services\Common\Gateway\Consolidator\ConsolidatorTransport;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;
use App\Repositories\Backend\User\TempUser\TempUserEloquentRepository;
use App\Repositories\Backend\User\TempUser\TempUserRepositoryContract;
use App\Services\Backend\Web\Notification\NotificationServiceContract;
use App\Repositories\Backend\Transaction\TransactionEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Gateway\Processing\ProcessingTransportContract;
use App\Repositories\Backend\CategoryType\CategoryTypeEloquentRepository;
use App\Repositories\Backend\CategoryType\CategoryTypeRepositoryContract;
use App\Repositories\Backend\Order\OrderType\OrderTypeEloquentRepository;
use App\Repositories\Backend\Order\OrderType\OrderTypeRepositoryContract;
use App\Repositories\Backend\Service\Category\CategoryEloquentRepository;
use App\Repositories\Backend\Service\Category\CategoryRepositoryContract;
use App\Repositories\Backend\TransferList\TransferListEloquentRepository;
use App\Repositories\Backend\TransferList\TransferListRepositoryContract;
use App\Repositories\Backend\User\Permission\PermissionEloquentRepository;
use App\Repositories\Backend\User\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\OrderCardType\OrderCardTypeEloquentRepository;
use App\Repositories\Backend\OrderCardType\OrderCardTypeRepositoryContract;
use App\Repositories\Backend\User\Attestation\AttestationEloquentRepository;
use App\Repositories\Backend\User\Attestation\AttestationRepositoryContract;
use App\Repositories\Backend\User\UserHistory\UserHistoryRepositoryContract;
use App\Repositories\Backend\User\UserSession\UserSessionEloquentRepository;
use App\Repositories\Backend\User\UserSession\UserSessionRepositoryContract;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusEloquentRepository;
use App\Repositories\Backend\Order\OrderStatus\OrderStatusRepositoryContract;
use App\Repositories\Backend\Service\Commission\CommissionEloquentRepository;
use App\Repositories\Backend\Service\Commission\CommissionRepositoryContract;
use App\Repositories\Backend\User\DocumentType\DocumentTypeEloquentRepository;
use App\Repositories\Backend\User\DocumentType\DocumentTypeRepositoryContract;
use App\Repositories\Backend\Account\AccountType\AccountTypeEloquentRepository;
use App\Repositories\Backend\Account\AccountType\AccountTypeRepositoryContract;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointEloquentRepository;
use App\Repositories\Backend\CoordinatePoint\CoordinatePointRepositoryContract;
use App\Repositories\Backend\Order\OrderHistory\OrderHistoryEloquentRepository;
use App\Repositories\Backend\Order\OrderHistory\OrderHistoryRepositoryContract;
use App\Repositories\Backend\Service\WorkDays\ServiceWorkdaysEloquentRepository;
use App\Repositories\Backend\Service\WorkDays\ServiceWorkdaysRepositoryContract;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemEloquentRepository;
use App\Repositories\Backend\Cashback\CashbackItem\CashbackItemRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRate\CurrencyRateEloquentRepository;
use App\Repositories\Backend\Currency\CurrencyRate\CurrencyRateRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantItem\MerchantItemRepositoryContract;
use App\Repositories\Backend\User\UnverifiedUser\UnverifiedUserEloquentRepository;
use App\Repositories\Backend\User\UnverifiedUser\UnverifiedUserRepositoryContract;
use App\Repositories\Backend\Account\AccountStatus\AccountStatusEloquentRepository;
use App\Repositories\Backend\Account\AccountStatus\AccountStatusRepositoryContract;
use App\Repositories\Backend\User\UserSessionCode\UserSessionCodeEloquentRepository;
use App\Repositories\Backend\User\UserSessionCode\UserSessionCodeRepositoryContract;
use App\Repositories\Backend\Account\AccountCategoryType\AccountCategoryTypeContract;
use App\Repositories\Backend\Account\AccountHistory\AccountHistoryEloquentRepository;
use App\Repositories\Backend\Account\AccountHistory\AccountHistoryRepositoryContract;
use App\Repositories\Backend\User\UserServiceLimit\UserServiceLimitEloquentRepository;
use App\Repositories\Backend\User\UserServiceLimit\UserServiceLimitRepositoryContract;
use App\Repositories\Backend\Service\ServiceOtpLimit\ServiceOtpLimitEloquentRepository;
use App\Repositories\Backend\Service\ServiceOtpLimit\ServiceOtpLimitRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCategory\MerchantCategoryEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantCategory\MerchantCategoryRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantWorkdays\MerchantWorkdaysEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantWorkdays\MerchantWorkdaysRepositoryContract;
use App\Repositories\Backend\Account\AccountTypeDetail\AccountTypeDetailEloquentRepository;
use App\Repositories\Backend\Account\AccountTypeDetail\AccountTypeDetailRepositoryContract;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusEloquentRepository;
use App\Repositories\Backend\Order\OrderProcessStatus\OrderProcessStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionType\TransactionTypeEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionType\TransactionTypeRepositoryContract;
use App\Repositories\Backend\User\UserSessionCodeType\UserSessionCodeTypeEloquentRepository;
use App\Repositories\Backend\User\UserSessionCodeType\UserSessionCodeTypeRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCommission\MerchantCommissionEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantCommission\MerchantCommissionRepositoryContract;
use App\Repositories\Backend\Account\AccountCategoryType\AccountCategoryTypeEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionStatus\TransactionStatusRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRateHistory\CurrencyRateHistoryEloquentRepository;
use App\Repositories\Backend\Currency\CurrencyRateHistory\CurrencyRateHistoryRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionHistory\TransactionHistoryEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionHistory\TransactionHistoryRepositoryContract;
use App\Repositories\Backend\Currency\CurrencyRateCategory\CurrencyRateCategoryEloquentRepository;
use App\Repositories\Backend\Currency\CurrencyRateCategory\CurrencyRateCategoryRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCommissionItem\MerchantCommissionItemEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantCommissionItem\MerchantCommissionItemRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionSyncStatus\TransactionSyncStatusRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionStatusGroup\TransactionStatusGroupRepositoryContract;
use App\Repositories\Backend\Merchant\MerchantCategoryMerchant\MerchantCategoryMerchantEloquentRepository;
use App\Repositories\Backend\Merchant\MerchantCategoryMerchant\MerchantCategoryMerchantRepositoryContract;
use App\Repositories\Backend\Transaction\TransactionStatusDetail\TransactionStatusDetailEloquentRepository;
use App\Repositories\Backend\Transaction\TransactionStatusDetail\TransactionStatusDetailRepositoryContract;
use App\Repositories\Backend\Service\ServiceLimit\ServiceLimitEloquentRepository as BackendServiceLimitEloquentRepository;
use App\Repositories\Backend\Service\ServiceLimit\ServiceLimitRepositoryContract as BackendServiceLimitRepositoryContract;
use App\Repositories\Backend\Branch\BranchRepositoryContract;
use App\Repositories\Backend\Branch\BranchEloquentRepository;
use App\Repositories\Backend\Order\OrderDepositType\OrderDepositTypeRepositoryContract;
use App\Repositories\Backend\Order\OrderDepositType\OrderDepositTypeEloquentRepository;
use App\Repositories\Backend\Order\OrderDepositTypeItem\OrderDepositTypeItemRepositoryContract;
use App\Repositories\Backend\Order\OrderDepositTypeItem\OrderDepositTypeItemEloquentRepository;
use App\Repositories\Backend\Order\OrderAccountType\OrderAccountTypeRepositoryContract;
use App\Repositories\Backend\Order\OrderAccountType\OrderAccountTypeEloquentRepository;
use App\Repositories\Backend\Order\OrderAccountTypeItem\OrderAccountTypeItemRepositoryContract;
use App\Repositories\Backend\Order\OrderAccountTypeItem\OrderAccountTypeItemEloquentRepository;
use App\Repositories\Backend\User\UserHistoryDwh\UserHistoryDwhEloquentRepository;

class BackendBindingServiceProvider extends ServiceProvider
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
        $this->app->bind(UserRepositoryContract::class, UserEloquentRepository::class);
        $this->app->bind(RoleRepositoryContract::class, RoleEloquentRepository::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionEloquentRepository::class);
        $this->app->bind(AttestationRepositoryContract::class, AttestationEloquentRepository::class);
        $this->app->bind(ServiceRepositoryContract::class, ServiceEloquentRepository::class);
        $this->app->bind(BackendServiceLimitRepositoryContract::class, BackendServiceLimitEloquentRepository::class);
        $this->app->bind(ServiceWorkdaysRepositoryContract::class, ServiceWorkdaysEloquentRepository::class);
        $this->app->bind(SettingRepositoryContract::class, SettingEloquentRepository::class);
        $this->app->bind(CategoryRepositoryContract::class, CategoryEloquentRepository::class);
        $this->app->bind(GatewayRepositoryContract::class, GatewayEloquentRepository::class);
        $this->app->bind(TransactionStatusRepositoryContract::class, TransactionStatusEloquentRepository::class);
        $this->app->bind(TransactionStatusDetailRepositoryContract::class, TransactionStatusDetailEloquentRepository::class);
        $this->app->bind(TransactionTypeRepositoryContract::class, TransactionTypeEloquentRepository::class);
        $this->app->bind(CommissionRepositoryContract::class, CommissionEloquentRepository::class);
        $this->app->bind(TransactionHistoryRepositoryContract::class, TransactionHistoryEloquentRepository::class);
        $this->app->bind(TransactionRepositoryContract::class, TransactionEloquentRepository::class);
        $this->app->bind(UserHistoryRepositoryContract::class, UserHistoryEloquentRepository::class);
        $this->app->bind(FavoriteRepositoryContract::class, FavoriteEloquentRepository::class);
        $this->app->bind(UserServiceLimitRepositoryContract::class, UserServiceLimitEloquentRepository::class);
        $this->app->bind(AccountTypeRepositoryContract::class, AccountTypeEloquentRepository::class);
        $this->app->bind(AccountTypeDetailRepositoryContract::class, AccountTypeDetailEloquentRepository::class);
        $this->app->bind(AccountRepositoryContract::class, AccountEloquentRepository::class);
        $this->app->bind(AccountHistoryRepositoryContract::class, AccountHistoryEloquentRepository::class);
        $this->app->bind(CurrencyRepositoryContract::class, CurrencyEloquentRepository::class);
        $this->app->bind(CurrencyRateRepositoryContract::class, CurrencyRateEloquentRepository::class);
        $this->app->bind(CurrencyRateHistoryRepositoryContract::class, CurrencyRateHistoryEloquentRepository::class);
        $this->app->bind(ProcessingTransportContract::class, ProcessingTransport::class);
        $this->app->bind(CoordinatePointRepositoryContract::class, CoordinatePointEloquentRepository::class);
        $this->app->bind(TransactionStatusGroupRepositoryContract::class, TransactionStatusGroupEloquentRepository::class);
        $this->app->bind(ClientRepositoryContract::class, ClientEloquentRepository::class);
        //Backend API CONSOLIDATOR
        $this->app->bind(ConsolidatorContract::class, ConsolidatorTransport::class);
        $this->app->bind(DocumentTypeRepositoryContract::class, DocumentTypeEloquentRepository::class);
        $this->app->bind(CountryRepositoryContract::class, CountryEloquentRepository::class);
        $this->app->bind(RegionRepositoryContract::class, RegionEloquentRepository::class);
        $this->app->bind(AreaRepositoryContract::class, AreaEloquentRepository::class);
        $this->app->bind(CityRepositoryContract::class, CityEloquentRepository::class);
        $this->app->bind(TempUserRepositoryContract::class, TempUserEloquentRepository::class);
        $this->app->bind(TempUserRepositoryContract::class, TempUserEloquentRepository::class);

        $this->app->bind(AccountStatusRepositoryContract::class, AccountStatusEloquentRepository::class);
        $this->app->bind(BankRepositoryContract::class, BankEloquentRepository::class);
        $this->app->bind(JobLogRepositoryContract::class, JobLogEloquentRepository::class);
        $this->app->bind(JobLogArchiveRepositoryContract::class, JobLogArchiveEloquentRepository::class);
        $this->app->bind(AccountCategoryTypeContract::class, AccountCategoryTypeEloquentRepository::class);
        $this->app->bind(CategoryTypeRepositoryContract::class, CategoryTypeEloquentRepository::class);
        $this->app->bind(ColorRepositoryContract::class, ColorEloquentRepository::class);
        $this->app->bind(EventRepositoryContract::class, EventEloquentRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderEloquentRepository::class);
        $this->app->bind(OrderTypeRepositoryContract::class, OrderTypeEloquentRepository::class);
        $this->app->bind(OrderStatusRepositoryContract::class, OrderStatusEloquentRepository::class);
        $this->app->bind(PurposeRepositoryContract::class, PurposeEloquentRepository::class);
        $this->app->bind(TransactionSyncStatusRepositoryContract::class, TransactionSyncStatusEloquentRepository::class);
        $this->app->bind(TransferListRepositoryContract::class, TransferListEloquentRepository::class);
        $this->app->bind(UnverifiedUserRepositoryContract::class, UnverifiedUserEloquentRepository::class);
        $this->app->bind(UserSessionCodeRepositoryContract::class, UserSessionCodeEloquentRepository::class);
        $this->app->bind(UserSessionRepositoryContract::class, UserSessionEloquentRepository::class);
        $this->app->bind(UserSessionCodeTypeRepositoryContract::class, UserSessionCodeTypeEloquentRepository::class);
        $this->app->bind(NewsRepositoryContract::class, NewsEloquentRepository::class);
        $this->app->bind(ServiceOtpLimitRepositoryContract::class, ServiceOtpLimitEloquentRepository::class);
        $this->app->bind(NotificationServiceContract::class, NotificationService::class);
        $this->app->bind(MerchantRepositoryContract::class, MerchantEloquentRepository::class);
        $this->app->bind(MerchantItemRepositoryContract::class, MerchantItemEloquentRepository::class);
        $this->app->bind(MerchantCategoryRepositoryContract::class, MerchantCategoryEloquentRepository::class);
        $this->app->bind(MerchantWorkdaysRepositoryContract::class, MerchantWorkdaysEloquentRepository::class);
        $this->app->bind(CashbackRepositoryContract::class, CashbackEloquentRepository::class);
        $this->app->bind(CashbackItemRepositoryContract::class, CashbackItemEloquentRepository::class);
        $this->app->bind(MerchantCategoryMerchantRepositoryContract::class, MerchantCategoryMerchantEloquentRepository::class);
        $this->app->bind(OrderProcessStatusRepositoryContract::class, OrderProcessStatusEloquentRepository::class);
        $this->app->bind(OrderHistoryRepositoryContract::class, OrderHistoryEloquentRepository::class);
        $this->app->bind(MerchantCommissionRepositoryContract::class, MerchantCommissionEloquentRepository::class);
        $this->app->bind(MerchantCommissionItemRepositoryContract::class, MerchantCommissionItemEloquentRepository::class);
        $this->app->bind(CurrencyRateCategoryRepositoryContract::class, CurrencyRateCategoryEloquentRepository::class);
        $this->app->bind(OrderCardTypeRepositoryContract::class, OrderCardTypeEloquentRepository::class);
        $this->app->bind(TransactionServiceContract::class, TransactionService::class);
        //$this->app->bind(DocumentTypeContract::class, DocumentTypeEloquentRepository::class);
        $this->app->bind(BranchRepositoryContract::class, BranchEloquentRepository::class);
        $this->app->bind(JobHistoryRepositoryContract::class, JobHistoryEloquentRepository::class);
        $this->app->bind(RemoteIdentificationRepositoryContract::class, RemoteIdentificationEloquentRepository::class);
        $this->app->bind(OrderCommentRepositoryContract::class, OrderCommentEloquentRepository::class);
        $this->app->bind(OrderCardContractTypeRepositoryContract::class, OrderCardContractTypeEloquentRepository::class);
        $this->app->bind(ReportTypeRepositoryContract::class, ReportTypeEloquentRepository::class);
        $this->app->bind(CashbackTypeRepositoryContract::class, CashbackTypeEloquentRepository::class );
        $this->app->bind(BonusAccrualRepositoryContract::class, BonusAccrualEloquentRepository::class);
        $this->app->bind(BonusAccrualStatusRepositoryContract::class, BonusAccrualStatusEloquentRepository::class);
        $this->app->bind(FAQQuestionRepositoryContract::class, FAQQuestionEloquentRepository::class);
        $this->app->bind(FAQAnswerRepositoryContract::class, FAQAnswerEloquentRepository::class);
        $this->app->bind(MerchantUserRepositoryContract::class, MerchantUserEloquentRepository::class);
        $this->app->bind(ScheduleTypeRepositoryContract::class, ScheduleTypeEloquentRepository::class);
        $this->app->bind(ScheduleRepositoryContract::class, ScheduleEloquentRepository::class);
        $this->app->bind(ScheduleJobRepositoryContract::class, ScheduleJobEloquentRepository::class);
        $this->app->bind(ReplenishmentEwalletEskhataTransactionsExportJobServiceContract::class, ReplenishmentEwalletEskhataTransactionsExportJobService::class);
        $this->app->bind(ReportAnalysisRepositoryContract::class, ReportAnalysisEloquentRepository::class);
        $this->app->bind(SplashScreenRepositoryContract::class, SplashScreenEloquentRepository::class);
        $this->app->bind(CoordinatePointTypeRepositoryContract::class, CoordinatePointTypeEloquentRepository::class);
        $this->app->bind(CoordinatePointWorkdayRepositoryContract::class, CoordinatePointWorkdayEloquentRepository::class);
        $this->app->bind(CoordinatePointServiceRepositoryContract::class, CoordinatePointServiceEloquentRepository::class);
        $this->app->bind(CoordinatePointTypeServiceRepositoryContract::class, CoordinatePointTypeServiceEloquentContract::class);
        $this->app->bind(CoordinatePointCityRepositoryContract::class, CoordinatePointCityEloquentRepository::class);
        $this->app->bind(OrderDepositTypeRepositoryContract::class, OrderDepositTypeEloquentRepository::class);
        $this->app->bind(OrderDepositTypeItemRepositoryContract::class, OrderDepositTypeItemEloquentRepository::class);
        $this->app->bind(OrderAccountTypeRepositoryContract::class, OrderAccountTypeEloquentRepository::class);
        $this->app->bind(OrderAccountTypeItemRepositoryContract::class, OrderAccountTypeItemEloquentRepository::class);
        $this->app->bind(TransactionContinueRuleRepositoryContract::class, TransactionContinueRuleEloquentRepository::class);
        $this->app->bind(TransactionContinueRuleAccordanceRepositoryContract::class, TransactionContinueRuleAccordanceEloquentRepository::class);
        $this->app->bind(DepositOpeningOrdersServiceContract::class, DepositOpeningOrdersService::class);
        $this->app->bind(UserHistoryServiceContract::class, UserHistoryService::class);
        $this->app->bind(UserHistoryDwhServiceContract::class, UserHistoryDwhService::class);
        $this->app->bind(JobLogServiceContract::class, JobLogService::class);
        $this->app->bind(JobLogDwhServiceContract::class, JobLogDwhService::class);
        $this->app->bind(JobLogDwhRepositoryContract::class, JobLogDwhEloquentRepository::class);
        $this->app->bind(UserHistoryDwhRepositoryContract::class, UserHistoryDwhEloquentRepository::class);
        $this->app->bind(DwhRuleServiceContract::class, DwhRuleService::class);
        $this->app->bind(DwhRuleRepositoryContract::class, DwhRuleEloquentRepository::class);
        $this->app->bind(TransactionHistoryRepositoryContract::class, TransactionHistoryEloquentRepository::class);
        $this->app->bind(TransactionHistoryDwhRepositoryContract::class, TransactionHistoryDwhEloquentRepository::class);
        $this->app->bind(TransactionHistoryServiceContract::class, TransactionHistoryService::class);
        $this->app->bind(TransactionHistoryDwhServiceContract::class, TransactionHistoryDwhService::class);
        $this->app->bind(KortiMilliTransactionExportJobServiceContract::class, KortiMilliTransactionExportJobService::class);
    }

    public function registerBindServices()
    {
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(MerchantServiceContract::class, MerchantService::class);
        $this->app->bind(TransactionExportJobServiceContract::class, TransactionExportJobService::class);
        $this->app->bind(ClientExportJobServiceContract::class, ClientExportJobService::class);
        $this->app->bind(RemoteIdentificationServiceContract::class, RemoteIdentificationService::class);
        $this->app->bind(MerchantExportJobServiceContract::class, MerchantExportJobService::class);
        $this->app->bind(RemoteIdentificationExportJobServiceContract::class, RemoteIdentificationExportJobService::class);
        $this->app->bind(MerchantQrTransactionsExportJobServiceContract::class, MerchantQrTransactionsExportJobService::class);
        $this->app->bind(BeetweenEwalletEskhataTransactionsExportJobServiceContract::class, BeetweenEwalletEskhataTransactionsExportJobService::class);
        $this->app->bind(OrderExportJobServiceContract::class, OrderExportJobService::class);
        $this->app->bind(TransactionAnalysisEwalletEskhataExportJobServiceContract::class, TransactionAnalysisEwalletEskhataExportJobService::class);
    }
}
