<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('goodcatch')->group(function(){
    Route::namespace('Admin')->prefix('admin')->group(function(){
        Route::group(['middleware'=>'jwt.admin'], function(){
            Route::apiResources([
                'modules'=>'ModuleController', // 系统模块化
            ]);
        });
    });

    /**
     *
     * @author hg <364825702@qq.com>
     * 商城商家后台 路由
     *
     */
    Route::namespace('Seller')->prefix('Seller')->group(function(){
        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });

    /**
     *
     * @author hg <364825702@qq.com>
     * 商城PC端 路由
     *
     */
    Route::namespace('Home')->group(function(){

        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });

    /**
     *
     * @author hg <364825702@qq.com>
     * 商城App端 路由
     *
     */
    Route::namespace('App')->prefix('App')->group(function(){

        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });
});


