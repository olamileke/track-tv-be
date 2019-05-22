<?php

use Illuminate\Http\Request;

// use Auth;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return Auth::guard('api')->user();
// });


Route::group(['middleware'=>'auth:api'], function() {

	Route::post('/user/image/upload', 'UsersController@imageUpload');

	Route::get('/getsubscriptions', 'SubscriptionsController@get'); 

	Route::post('/logout', 'Auth\LoginController@logout');

	Route::post('/hassubscribed/{id}', 'SubscriptionsController@hasSubscribed');

	Route::post('/unsubscribe/{id}', 'SubscriptionsController@unsubscribe');

	Route::get('/getsubscribedids', 'SubscriptionsController@getSubIDs');

	Route::post('/subscribe', 'SubscriptionsController@subscribe');

	Route::get('/user', function() {

		return Auth::guard('api')->user();
	});

});

Route::post('/register', 'Auth\RegisterController@register');

Route::post('/login', 'Auth\LoginController@login');

Route::post('/account/activate/{token}', 'UsersController@activate');

Route::post('/sendresetmail', 'UsersController@sendResetMail');

Route::post('/checkresettoken/{token}', 'UsersController@checkResetToken');

Route::post('/resetpassword/{token}', 'UsersController@resetPassword');


