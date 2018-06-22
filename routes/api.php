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
Route::prefix('user')->group(function() {
    Route::group(['middleware' => ['api','cors']], function () {
        Route::post('register', 'Auth\ApiRegisterController@register');
        Route::post('login', 'Auth\ApiAuthController@login');
    
    });
    
    Route::middleware('jwt-auth')->get('', function(){
        return (Auth::user());
    });
    Route::middleware('jwt-auth')->get('logout', function(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['response'=>'success', 'result'=>'logged out'], 200);
    });
});

Route::group(['prefix' => 'calculation', 'middleware' => 'jwt-auth'], function()
{
    Route::post('', 'CalculationController@cashbox');
    Route::get('', 'CalculationController@showCashbox');
});