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

Route::group(['namespace' => 'admin','prefix' => 'admin'],function () {

    // 登录接口
    Route::post('login','LoginController@login');

    // 获取公钥
    Route::get('getPublicKey','LoginController@getPublicKey');


    Route::group(['middleware' => 'checkLogin'],function () {

        // 首页
        Route::get('index','IndexController@index');
    });
});
