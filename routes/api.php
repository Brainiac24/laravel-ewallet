<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['namespace' => 'Frontend', 'prefix' => 'v1'], function () {

    Route::group(['namespace' => 'Api'], function () {

        require(__DIR__ . '/Frontend/Api/CurrencyRate.php');
        require(__DIR__ . '/Frontend/Api/CoordinatePoint.php');
        require(__DIR__ . '/Frontend/Api/LicenseAgreement.php');

        //Route::post('/login', ['as' => 'auth.login', 'uses' => 'Access\Auth\AuthController@authenticate']);
        //Route::get('/token', ['as' => 'auth.getToken', 'uses' => 'Access\Auth\AuthController@getToken']);
        //Route::get('/token', ['as' => 'auth.getToken', 'uses' => 'Access\Auth\AuthController@getToken']);
//'checkAppVersion'
        Route::group(['middleware' => ['checkExistToken',]], function () {
            require(__DIR__ . '/Frontend/Api/Buglog.php');
            Route::post('/auth/hello', ['as' => 'auth.hello', 'uses' => 'User\Auth\AuthController@hello']);
            Route::post('/auth/phone', ['as' => 'auth.registerPhone', 'uses' => 'User\Auth\AuthController@registerPhone']);
            Route::post('/auth/phone/confirm', ['as' => 'auth.registerPhoneConfirm', 'uses' => 'User\Auth\AuthController@registerPhoneConfirm']);
            Route::post('/register/pin', ['as' => 'auth.registerPin', 'uses' => 'User\Auth\AuthController@registerPin']);
            Route::post('/auth/pin', ['as' => 'auth.authPin', 'uses' => 'User\Auth\AuthController@authPin']);
            Route::post('/reset/pin', ['as' => 'reset.Pin', 'uses' => 'User\Auth\AuthController@resetPin']);
            Route::post('/reset/pin/confirm', ['as' => 'reset.pinConfirm', 'uses' => 'User\Auth\AuthController@resetPinConfirm']);
            Route::post('/reset/register/pin', ['as' => 'reset.registerPin', 'uses' => 'User\Auth\AuthController@resetRegisterPin']);
        });


        Route::post('/refresh', ['as' => 'auth.refresh', 'uses' => 'User\Auth\AuthController@refreshToken'])->middleware('validateRefreshToken');

        //FORTEST - \App::environment('local') ? [] : ['validateAccessToken', 'checkAppVersion']
        Route::group(['middleware' => ['validateAccessToken', 'checkAppVersion']], function () {

            require(__DIR__ . '/Frontend/Api/User.php');
            require(__DIR__ . '/Frontend/Api/Account.php');
            require(__DIR__ . '/Frontend/Api/Category.php');
            require(__DIR__ . '/Frontend/Api/Service.php');
            require(__DIR__ . '/Frontend/Api/Transaction.php');
            require(__DIR__ . '/Frontend/Api/Attestation.php');
            require(__DIR__ . '/Frontend/Api/Setting.php');
            require(__DIR__ . '/Frontend/Api/Favorite.php');

            Route::post('/logout', ['as' => 'auth.logout', 'uses' => 'User\Auth\AuthController@logout']);
            Route::post('/settings/pin/change', ['as' => 'settings.changePin', 'uses' => 'User\Auth\AuthController@changePin']);
            Route::post('/settings/email', ['as' => 'settings.registerEmail', 'uses' => 'User\Auth\AuthController@registerEmail']);
            Route::post('/settings/email/confirm', ['as' => 'settings.registerEmailConfirm', 'uses' => 'User\Auth\AuthController@registerEmailConfirm']);
            Route::post('/push/token', ['as' => 'auth.setPushToken', 'uses' => 'User\Auth\AuthController@pushToken']);

        });
    });
});

Route::group(['namespace' => 'Backend\Api', 'prefix' => 'v1'], function () {
    require(__DIR__ . '/Backend/Api/Consolidator.php');
    require(__DIR__ . '/Backend/Api/Soniya.php');
    require(__DIR__ . '/Backend/Api/Identification.php');
    require(__DIR__ . '/Backend/Api/Transaction.php');
    require(__DIR__ . '/Backend/Api/CurrencyRate.php');
//    require(__DIR__ . '/Backend/Api/Country.php');
    require(__DIR__ . '/Backend/Api/Region.php');
    require(__DIR__ . '/Backend/Api/Area.php');
    require(__DIR__ . '/Backend/Api/City.php');
//    require(__DIR__ . '/Backend/Api/DocApi.php');
});
