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
    
    Route::middleware('jwt-auth')->post('', function(){
        return (Auth::user());
    });
    Route::middleware('jwt-auth')->post('logout', function(){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['user'=>'logged_out'], 205);
    });
});
