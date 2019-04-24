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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return Auth::guard('api')->user();
// });


Route::group(['middleware'=>'auth:api'], function() {

	Route::post('/user/image/upload', 'UsersController@imageUpload');

	Route::get('/getsubscriptions', 'SubscriptionsController@get'); 

	Route::post('/logout', 'Auth\LoginController@logout');

});

Route::post('/register', 'Auth\RegisterController@register');

Route::post('/login', 'Auth\LoginController@login');

Route::post('/account/activate/{token}', 'UsersController@activate');

