<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'sl','middleware' => 'cors'], function () {

    //Route::get('/verify-otp', 'Api\SecondLifeApiController@verifyOtp')->name('sl.verify_otp');
    //Route::get('/verify-otp-and-submit-user-info', 'Api\SecondLifeApiController@verifyOtpAndSubmitUserInfo')->name('sl.verify_otp_and_submit_user_info');
    //Route::get('/create-user', 'Api\SecondLifeApiController@createUser')->name('sl.create_user');

    Route::post('/verify-otp', 'Api\SecondLifeApiController@verifyOtp')->name('sl.verify_otp');
    Route::post('/verify-otp-and-submit-user-info', 'Api\SecondLifeApiController@verifyOtpAndSubmitUserInfo')->name('sl.verify_otp_and_submit_user_info');
    Route::any('/create-user', 'Api\SecondLifeApiController@createUser')->name('sl.create_user');
    Route::post('/reset-password', 'Api\SecondLifeApiController@resetPassword')->name('sl.reset_password');

    Route::any('/add-balance-to-user', 'Api\SecondLifeApiPaymentController@addBalanceToUser')->name('sl.add-balance-to-user');
    Route::post('/get-user-balance', 'Api\SecondLifeApiPaymentController@getUserBalance')->name('sl.get_user_balance');
    Route::any('/purchase-plan', 'Api\SecondLifeApiPaymentController@purchasePlan')->name('sl.purchase-plan');
    Route::any('/prepurchase-plan', 'Api\SecondLifeApiPaymentController@prepurchasePlan')->name('sl.prepurchase-plan');
    Route::post('/purchase-plan-feature', 'Api\SecondLifeApiPaymentController@purchasePlanFeature')->name('sl.purchase_plan_feature');    
    Route::post('/purchase-token', 'Api\SecondLifeApiPaymentController@purchaseToken')->name('sl.purchase_token');
    Route::post('/add-donation', 'Api\SecondLifeApiPaymentController@addDonation')->name('sl.add_donation');
    Route::post('/add-advertisement', 'Api\SecondLifeApiPaymentController@addAdvertisement')->name('sl.add_advertisement');
    Route::post('/add-parcel-info', 'Api\SecondLifeApiParcelController@addParcelInfo')->name('sl.add_parcel_info');
    Route::post('/add-terminal-info', 'Api\SecondLifeApiParcelController@addTerminalInfo')->name('sl.add_terminal_info');
    Route::post('/used-terminal', 'Api\SecondLifeApiParcelController@usedTerminal')->name('sl.used-terminal');
    Route::post('/delete-terminal', 'Api\SecondLifeApiParcelController@deleteTerminal')->name('sl.delete-terminal');

    Route::post('/pay-checkout', 'Api\SecondLifeApiPaymentController@payCheckout')->name('sl.pay_checkout');
    Route::post('/pay-checkout-info', 'Api\SecondLifeApiPaymentController@payCheckoutInfo')->name('sl.pay_Checkout_Info');
    

    Route::post('/get-notifications', 'Api\SecondLifeApiNotificationController@getNotifications')->name('sl.get_notifications');
    Route::post('/add-notifications', 'Api\SecondLifeApiPaymentController@addNotifications')->name('sl.add_notifications');
    Route::post('/add-sl-notifications', 'Api\SecondLifeApiNotificationController@addSLnotifications')->name('sl.add_sl_notifications');

    Route::post('/get-all-notifications', 'Api\SecondLifeApiNotificationController@getAllnotifications')->name('sl.get_all_notifications');
    
    Route::any('/get-pay-data', 'Api\SecondLifeApiPaymentController@getPayData')->name('sl.get-pay-data');
    Route::any('/update-user', 'Api\SecondLifeApiPaymentController@updateUser')->name('sl.update-user');

    Route::any('/new-pay-plan', 'Api\SecondLifeApiPaymentController@newPayPlan')->name('sl.new-pay-plan');

    Route::any('/to-pay-info', 'Api\SecondLifeApiPaymentController@toPayInfo')->name('sl.to-pay-info');
    
});
