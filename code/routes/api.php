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


        // 管理员模块
        Route::group(['prefix' => 'admin'],function () {
            Route::get('/getList','AdminController@getList');
            Route::post('/create','AdminController@create');
            Route::get('/detail','AdminController@detail');
            Route::post('/changeStatus','AdminController@changeStatus');
            Route::post('/delete','AdminController@delete');
            Route::post('/changePassword','AdminController@changePassword');
            Route::post('/update','AdminController@update');
        });

        // 角色模块
        Route::group(['prefix' => 'role'],function () {
            Route::get('/getList','RoleController@getList');
            Route::post('/create','RoleController@create');
            Route::get('/detail','RoleController@detail');
            Route::post('/changeStatus','RoleController@changeStatus');
            Route::post('/delete','RoleController@delete');
            Route::post('/update','RoleController@update');
        });


        // 角色模块
        Route::group(['prefix' => 'permission'],function () {
            Route::get('/getList','PermissionController@getList');
            Route::post('/create','PermissionController@create');
            Route::get('/detail','PermissionController@detail');
            Route::post('/delete','PermissionController@delete');
            Route::post('/update','PermissionController@update');
            Route::get('/getPermissionSelect','PermissionController@getPermissionSelect');
        });
    });
});
