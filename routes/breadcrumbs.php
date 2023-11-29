<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 11.07.2017
 * Time: 16:42
 */

// Home
Breadcrumbs::register('admin.dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});
Breadcrumbs::register('admin.redirectFromIndexPage', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('admin.dashboard'));
});
require(__DIR__ . '/Breadcrumbs/Backend/Registry.php');
require(__DIR__ . '/Breadcrumbs/Backend/UserServiceLimit.php');
require(__DIR__ . '/Breadcrumbs/Backend/UserHistory.php');
require(__DIR__ . '/Breadcrumbs/Backend/User.php');
require(__DIR__ . '/Breadcrumbs/Backend/Role.php');
require(__DIR__ . '/Breadcrumbs/Backend/Attestation.php');
require(__DIR__ . '/Breadcrumbs/Backend/Service.php');
require(__DIR__ . '/Breadcrumbs/Backend/Menu.php');
require(__DIR__ . '/Breadcrumbs/Backend/ServiceLimits.php');
require(__DIR__ . '/Breadcrumbs/Backend/ServiceWorkDays.php');
require(__DIR__ . '/Breadcrumbs/Backend/Setting.php');
require(__DIR__ . '/Breadcrumbs/Backend/Category.php');
require(__DIR__ . '/Breadcrumbs/Backend/Gateway.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionStatus.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionStatusDetail.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionStatusGroup.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionSyncStatus.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionType.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionContinueRuleAccordance.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionContinueRule.php');
require(__DIR__ . '/Breadcrumbs/Backend/Commission.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransactionHistory.php');
require(__DIR__ . '/Breadcrumbs/Backend/Transaction.php');
require(__DIR__ . '/Breadcrumbs/Backend/Favorite.php');
require(__DIR__ . '/Breadcrumbs/Backend/AccountType.php');
require(__DIR__ . '/Breadcrumbs/Backend/AccountTypeDetail.php');
require(__DIR__ . '/Breadcrumbs/Backend/AccountStatus.php');
require(__DIR__ . '/Breadcrumbs/Backend/Account.php');
require(__DIR__ . '/Breadcrumbs/Backend/AccountHistory.php');
require(__DIR__ . '/Breadcrumbs/Backend/CurrencyRateHistory.php');
require(__DIR__ . '/Breadcrumbs/Backend/CurrencyRate.php');
require(__DIR__ . '/Breadcrumbs/Backend/Currency.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePoints.php');
require(__DIR__ . '/Breadcrumbs/Backend/Client.php');
require(__DIR__ . '/Breadcrumbs/Backend/LicenseAgreement.php');
require(__DIR__ . '/Breadcrumbs/Backend/DocApi.php');
require(__DIR__ . '/Breadcrumbs/Backend/Country.php');
require(__DIR__ . '/Breadcrumbs/Backend/Region.php');
require(__DIR__ . '/Breadcrumbs/Backend/Area.php');
require(__DIR__ . '/Breadcrumbs/Backend/City.php');
require(__DIR__ . '/Breadcrumbs/Backend/Error.php');
require(__DIR__ . '/Breadcrumbs/Backend/JobLog.php');
require(__DIR__ . '/Breadcrumbs/Backend/JobHistory.php');
require(__DIR__ . '/Breadcrumbs/Backend/AccountCategoryType.php');
require(__DIR__ . '/Breadcrumbs/Backend/Bank.php');
require(__DIR__ . '/Breadcrumbs/Backend/CategoryType.php');
require(__DIR__ . '/Breadcrumbs/Backend/Color.php');
require(__DIR__ . '/Breadcrumbs/Backend/DocumentType.php');
require(__DIR__ . '/Breadcrumbs/Backend/Event.php');
require(__DIR__ . '/Breadcrumbs/Backend/Order.php');
require(__DIR__ . '/Breadcrumbs/Backend/RemoteIdentification.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderType.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderStatus.php');
require(__DIR__ . '/Breadcrumbs/Backend/TempUser.php');
require(__DIR__ . '/Breadcrumbs/Backend/Purpose.php');
require(__DIR__ . '/Breadcrumbs/Backend/TransferList.php');
require(__DIR__ . '/Breadcrumbs/Backend/UnverifiedUser.php');
require(__DIR__ . '/Breadcrumbs/Backend/UserSessionCode.php');
require(__DIR__ . '/Breadcrumbs/Backend/News.php');
require(__DIR__ . '/Breadcrumbs/Backend/ServiceOtpLimits.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantItem.php');
require(__DIR__ . '/Breadcrumbs/Backend/Merchant.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantCategory.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantWorkdays.php');
require(__DIR__ . '/Breadcrumbs/Backend/Cashback.php');
require(__DIR__ . '/Breadcrumbs/Backend/CashbackItem.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantCommission.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantCommissionItem.php');
require(__DIR__ . '/Breadcrumbs/Backend/WithdrawMerchant.php');
require(__DIR__ . '/Breadcrumbs/Backend/Profile.php');
require(__DIR__ . '/Breadcrumbs/Backend/ReportMerchant.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderComment.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderCardType.php');
require(__DIR__ . '/Breadcrumbs/Backend/Report.php');
require(__DIR__ . '/Breadcrumbs/Backend/BonusAccrualStatus.php');
require(__DIR__ . '/Breadcrumbs/Backend/BonusAccrual.php');
require(__DIR__ . '/Breadcrumbs/Backend/CashbackType.php');
require(__DIR__ . '/Breadcrumbs/Backend/FAQAnswer.php');
require(__DIR__ . '/Breadcrumbs/Backend/FAQQuestion.php');
require(__DIR__ . '/Breadcrumbs/Backend/MerchantUser.php');
require(__DIR__ . '/Breadcrumbs/Backend/SplashScreen.php');
require(__DIR__ . '/Breadcrumbs/Backend/ScheduleJob.php');
require(__DIR__ . '/Breadcrumbs/Backend/ScheduleType.php');
require(__DIR__ . '/Breadcrumbs/Backend/Schedule.php');
require(__DIR__ . '/Breadcrumbs/Backend/FileManager.php');
require(__DIR__ . '/Breadcrumbs/Backend/ReportAnalysis.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderDepositType.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderDepositTypeItem.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderAccountType.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderAccountTypeItem.php');
require(__DIR__ . '/Breadcrumbs/Backend/Branch.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePointWorkday.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePointService.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePointTypeService.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePointType.php');
require(__DIR__ . '/Breadcrumbs/Backend/CoordinatePointCity.php');
require(__DIR__ . '/Breadcrumbs/Backend/DwhRule.php');
require(__DIR__ . '/Breadcrumbs/Backend/OrderCardContractType.php');


