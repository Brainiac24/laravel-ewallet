<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//TEST ROUTES
require(__DIR__ . '/Backend/Web/test.php');
//TEST ROUTES

//Route::get('/test_phpinfo', ['as' => 'test', 'uses' => 'TestController@php_info']);

Route::group(['namespace' => 'Backend', 'prefix' => 'admin'], function () {

    Route::group(['namespace' => 'Web'], function () {

        require(__DIR__ . '/Backend/Web/Auth.php');

        Route::group(['middleware' => ['auth', 'isActive']], function (){
            require(__DIR__ . '/Backend/Web/ChangePassword.php');
        });

        Route::group(['middleware' => ['auth', 'isActive', 'changePassword','rememberSearchFields']], function () {

            Route::get('/', 'DashboardController@redirectFromIndexPage')->name('admin.redirectFromIndexPage');

            Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

            Route::get('/log', '\Srmilon\LogViewer\LogViewerController@index');

            require(__DIR__ . '/Backend/Web/CoordinatePoint.php');
            require(__DIR__ . '/Backend/Web/Registry.php');
            require(__DIR__ . '/Backend/Web/Event.php');
            require(__DIR__ . '/Backend/Web/TempUser.php');
            require(__DIR__ . '/Backend/Web/UserSessionCode.php');
            require(__DIR__ . '/Backend/Web/UnverifiedUser.php');
            require(__DIR__ . '/Backend/Web/UserHistory.php');
            require(__DIR__ . '/Backend/Web/User.php');
            require(__DIR__ . '/Backend/Web/Role.php');
            require(__DIR__ . '/Backend/Web/Attestation.php');
            require(__DIR__ . '/Backend/Web/ServiceLimit.php');
            require(__DIR__ . '/Backend/Web/ServiceWorkDays.php');
            require(__DIR__ . '/Backend/Web/ServiceOtpLimit.php');
            require(__DIR__ . '/Backend/Web/Menu.php');
            require(__DIR__ . '/Backend/Web/Setting.php');
            require(__DIR__ . '/Backend/Web/Category.php');
            require(__DIR__ . '/Backend/Web/CurrencyRateHistory.php');
            require(__DIR__ . '/Backend/Web/CurrencyRate.php');
            require(__DIR__ . '/Backend/Web/Currency.php');
            require(__DIR__ . '/Backend/Web/Gateway.php');
            require(__DIR__ . '/Backend/Web/TransactionStatus.php');
            require(__DIR__ . '/Backend/Web/TransactionStatusDetail.php');
            require(__DIR__ . '/Backend/Web/TransactionStatusGroup.php');
            require(__DIR__ . '/Backend/Web/TransactionSyncStatus.php');
            require(__DIR__ . '/Backend/Web/TransactionType.php');
            require(__DIR__ . '/Backend/Web/TransactionContinueRuleAccordance.php');
            require(__DIR__ . '/Backend/Web/TransactionContinueRule.php');
            require(__DIR__ . '/Backend/Web/Commission.php');
            require(__DIR__ . '/Backend/Web/TransactionHistory.php');
            require(__DIR__ . '/Backend/Web/Transaction.php');
            require(__DIR__ . '/Backend/Web/Favorite.php');
            require(__DIR__ . '/Backend/Web/UserServiceLimit.php');
            require(__DIR__ . '/Backend/Web/AccountType.php');
            require(__DIR__ . '/Backend/Web/AccountTypeDetail.php');
            require(__DIR__ . '/Backend/Web/AccountHistory.php');
            require(__DIR__ . '/Backend/Web/AccountStatus.php');
            require(__DIR__ . '/Backend/Web/Account.php');
            require(__DIR__ . '/Backend/Web/Service.php');
            require(__DIR__ . '/Backend/Web/Client.php');
            require(__DIR__ . '/Backend/Web/LicenseAgreement.php');
            require(__DIR__ . '/Backend/Web/DocApi.php');
            require(__DIR__ . '/Backend/Web/Country.php');
            require(__DIR__ . '/Backend/Web/Regions.php');
            require(__DIR__ . '/Backend/Web/Area.php');
            require(__DIR__ . '/Backend/Web/City.php');
            require(__DIR__ . '/Backend/Web/Error.php');
            require(__DIR__ . '/Backend/Web/JobLog.php');
            require(__DIR__ . '/Backend/Web/JobHistory.php');
            require(__DIR__ . '/Backend/Web/AccountCategoryType.php');
            require(__DIR__ . '/Backend/Web/Bank.php');
            require(__DIR__ . '/Backend/Web/CategoryType.php');
            require(__DIR__ . '/Backend/Web/Color.php');
            require(__DIR__ . '/Backend/Web/DocumentType.php');
            require(__DIR__ . '/Backend/Web/OrderType.php');
            require(__DIR__ . '/Backend/Web/OrderStatus.php');
            require(__DIR__ . '/Backend/Web/Order.php');
            require(__DIR__ . '/Backend/Web/RemoteIdentification.php');
            require(__DIR__ . '/Backend/Web/Purpose.php');
            require(__DIR__ . '/Backend/Web/TransferList.php');
            require(__DIR__ . '/Backend/Web/News.php');
            require(__DIR__ . '/Backend/Web/MerchantItem.php');
            require(__DIR__ . '/Backend/Web/MerchantCategory.php');
            require(__DIR__ . '/Backend/Web/MerchantWorkdays.php');
            require(__DIR__ . '/Backend/Web/MerchantCommissionItem.php');
            require(__DIR__ . '/Backend/Web/MerchantCommission.php');
            require(__DIR__ . '/Backend/Web/MerchantUser.php');
            require(__DIR__ . '/Backend/Web/Merchant.php');
            require(__DIR__ . '/Backend/Web/CashbackItem.php');
            require(__DIR__ . '/Backend/Web/Cashback.php');
            require(__DIR__ . '/Backend/Web/WithdrawMerchant.php');
            require(__DIR__ . '/Backend/Web/Profile.php');
            require(__DIR__ . '/Backend/Web/ReportMerchant.php');
            require(__DIR__ . '/Backend/Web/ReportAnalysis.php');
            require(__DIR__ . '/Backend/Web/OrderComment.php');
            require(__DIR__ . '/Backend/Web/OrderCardType.php');
            require(__DIR__ . '/Backend/Web/Report.php');
            require(__DIR__ . '/Backend/Web/CashbackType.php');
            require(__DIR__ . '/Backend/Web/BonusAccrualStatus.php');
            require(__DIR__ . '/Backend/Web/BonusAccrual.php');
            require(__DIR__ . '/Backend/Web/FAQAnswer.php');
            require(__DIR__ . '/Backend/Web/FAQQuestion.php');
            require(__DIR__ . '/Backend/Web/SplashScreen.php');
            require(__DIR__ . '/Backend/Web/ScheduleJob.php');
            require(__DIR__ . '/Backend/Web/ScheduleType.php');
            require(__DIR__ . '/Backend/Web/Schedule.php');
            require(__DIR__ . '/Backend/Web/FileManager.php');
            require(__DIR__ . '/Backend/Web/OrderAccountType.php');
            require(__DIR__ . '/Backend/Web/OrderAccountTypeItem.php');
            require(__DIR__ . '/Backend/Web/OrderDepositType.php');
            require(__DIR__ . '/Backend/Web/OrderDepositTypeItem.php');
            require(__DIR__ . '/Backend/Web/Branch.php');
            require(__DIR__ . '/Backend/Web/CoordinatePointWorkday.php');
            require(__DIR__ . '/Backend/Web/CoordinatePointService.php');
            require(__DIR__ . '/Backend/Web/CoordinatePointTypeService.php');
            require(__DIR__ . '/Backend/Web/CoordinatePointType.php');
            require(__DIR__ . '/Backend/Web/CoordinatePointCity.php');
            require(__DIR__ . '/Backend/Web/DwhRule.php');
            require(__DIR__ . '/Backend/Web/OrderCardContractType.php');
        });

    });

    Route::group(['namespace' => 'Api'], function () {

    });
});


