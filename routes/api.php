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


Route::group(['prefix' => 'v1'], function() {

	Route::group(['prefix' => 'sgks-member'], function() {
		Route::post('listing', array('uses' => 'Master\MemberController@listing'));
        Route::post('add-member', array('uses' => 'Master\MemberController@addMember'));
	});

	Route::group(['prefix' => 'sgks-event'], function() {
		Route::post('listing', array('uses' => 'Master\EventController@listing'));
	});

	Route::group(['prefix' => 'sgks-committee'], function() {
		Route::post('listing', array('uses' => 'Master\CommitteeController@listing'));
	});

	Route::group(['prefix' => 'sgks-message'], function() {
		Route::post('listing', array('uses' => 'Master\MessageController@listing'));
	});

	Route::group(['prefix' => 'sgks-classified'], function() {
		Route::post('listing', array('uses' => 'Master\ClassifiedController@listing'));
	});

	Route::group(['prefix' => 'sgks-account'], function() {
		Route::post('listing', array('uses' => 'Master\AccountController@listing'));
	});

	Route::group(['prefix' => 'sgks-public'], function() {
		Route::get('health-plus/{sgks_city}/{language_id}', array('uses' => 'Master\WebviewController@healthPlus'));
		Route::get('privacy-policy/{sgks_city}/{language_id}', array('uses' => 'Master\WebviewController@privacyPolicy'));
		Route::get('help/{sgks_city}/{language_id}', array('uses' => 'Master\WebviewController@help'));
		Route::get('q-a/{sgks_city}/{language_id}', array('uses' => 'Master\WebviewController@qa'));
		Route::get('contact-us/{sgks_city}/{language_id}', array('uses' => 'Master\WebviewController@contactUs'));

		Route::get('master-list', array('uses' => 'Master\WebviewController@masterList'));

		Route::post('addmetosgks', array('uses' => 'Master\WebviewController@addMeToSgks'));
		Route::post('sgks-suggestion', array('uses' => 'Master\WebviewController@sgksSuggestion'));
		Route::get('sgks-version', array('uses' => 'Master\WebviewController@minimumSupportedVersion'));

	});

    Route::group(['prefix' => 'sgks-offline'], function() {
        Route::post('local-storage-offline', array('uses' => 'Master\OfflineStorageController@localStorageOffline'));
    });

    Route::group(['prefix' => 'sgks-miss'], function() {
        Route::post('get-city', array('uses' => 'Master\MiscellaneousController@getCity'));
        Route::get('get-bloodgroups', array('uses' => 'Master\MiscellaneousController@getBloodGroupMaster'));
        Route::post('get-otp', array('uses' => 'Auth\OtpVerificationController@getOtp'));
        Route::post('verify-otp', array('uses' => 'Auth\OtpVerificationController@verifyOtp'));
        Route::post('image-upload', array('uses' => 'Master\MiscellaneousController@imageUpload'));
    });

});