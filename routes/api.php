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


});