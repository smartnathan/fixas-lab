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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){
	Route::post('/users/register', 'Api\\UsersController@register');
	
	Route::middleware('auth:api')->group(function(){
		Route::patch('/users/{user_id}/fund-account', 'Api\\UsersController@fund_account');
	Route::patch('/users/{user_id}/withdraw', 'Api\\UsersController@withdraw_from_account');
	});
});
