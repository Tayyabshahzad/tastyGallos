<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

    Route::post('user-status', ['as' => 'user.status', 'uses' => 'App\Http\Controllers\Api\UserController@checkStatus']);
    Route::post('catch', ['as' => 'token.get', 'uses' => 'App\Http\Controllers\Api\OrderController@catch']);
    Route::get('processing/order/{order}', ['as' => 'orderProcessing', 'uses' => 'App\Http\Controllers\Api\OrderController@process']);
    Route::post('payment/status', ['as' => 'paymentStatus', 'uses' => 'App\Http\Controllers\Api\OrderController@catchPayment']);

    Route::group(['prefix'=>'user','as'=> 'api.','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('login',            ['as' => 'user.login','uses' => 'UserController@login']);
        Route::post('register',         ['as' => 'user.register','uses' => 'UserController@register']);
        Route::post('password-forgot',  ['as' => 'user.password.forgot','uses' => 'NewPasswordController@forgotPassword']);
        Route::post('validate-token',   ['as' => 'user.password.token.validation','uses' => 'NewPasswordController@validateToken']);
        Route::post('new-password',   ['as' => 'user.password.reset','uses' => 'NewPasswordController@setNewPassword']);
        Route::group(['middleware'=>'web'], function () {
            Route::get('register/github',          ['as' => 'gitRedirect',   'uses' => 'UserController@githubRedirect']);
            Route::get('register/callback/github', ['as' => 'gitCallback',   'uses' => 'UserController@githubCallback']);
            Route::get('register/google',          ['as' => 'googleRedirect','uses' => 'UserController@googleRedirect']);
            Route::get('register/callback/google', ['as' => 'googleCallback','uses' => 'UserController@googleCallback']);
        });
        Route::group(['middleware'=>'auth:api'], function () {
            Route::get('all',     ['as' => 'user.all',    'uses' => 'UserController@listing']);
            Route::get('{id}',    ['as' => 'user.single', 'uses' => 'UserController@singleUser']);
            Route::post('logout', ['as' => 'user.logout', 'uses' => 'UserController@logOut']);
            Route::post('profile/update', ['as' => 'user.profile.update', 'uses' => 'UserController@updateProfile']);
            Route::post('add/account', ['as' => 'user.add.account', 'uses' => 'UserController@addAccount']);
        });
    });
    Route::group(['middleware'=>'auth:api'], function () {
        Route::group(['as'=>'franchise.','prefix'=>'franchise','namespace'=>'App\Http\Controllers\Api'], function () {
            Route::post('locations',     ['as' => 'location', 'uses' => 'FranchiseController@locations']);
            Route::get('all/{type?}',   ['as' => 'all', 'uses' => 'FranchiseController@all']);
            Route::get('{id}',          ['as' => 'single', 'uses' => 'FranchiseController@single']);
            Route::post('byId',          ['as' => 'byId', 'uses' => 'FranchiseController@byIds']);
            //Route::get('type/delivery', ['as' => 'type.delivery', 'uses' => 'FranchiseController@delivery']);
            //Route::get('type/pickup',   ['as' => 'type.pickup', 'uses' => 'FranchiseController@pickup']);
        });
        Route::group(['as'=>'promotions.','prefix'=>'promotion','namespace'=>'App\Http\Controllers\Api'], function () {
            Route::get('all', ['as' => 'all', 'uses' => 'PromotionController@index']);
        });
        Route::group(['as'=>'products.','prefix'=>'products','namespace'=>'App\Http\Controllers\Api'], function () {
            Route::get('all/{id?}', ['as' => 'products.index', 'uses' => 'ProductController@index']);
            Route::get('single/{id}', ['as' => 'products.index', 'uses' => 'ProductController@single']);
        });
        Route::group(['as'=>'banner.','prefix'=>'banners','namespace'=>'App\Http\Controllers\Api'], function () {
            Route::get('all',     ['as' => 'all', 'uses' => 'PromotionController@banners']);
        });

    });
//ee
    Route::group(['as'=>'orders.','prefix'=>'orders','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('take',     ['as' => 'take', 'uses' => 'OrderController@take']);
        Route::get('payment/init/{id}',     ['as' => 'payment.init', 'uses' => 'OrderController@paymentInit']);
        Route::post('payment/confirm',     ['as' => 'payment.confirm', 'uses' => 'OrderController@paymentConfirm']);
        Route::get('user/{id}',     ['as' => 'take', 'uses' => 'OrderController@ordersByUser']); // Collection of users
        Route::get('single/{id}',     ['as' => 'take', 'uses' => 'OrderController@singleOrder']);
        Route::post('refund', ['as' => 'refund', 'uses' => 'OrderController@refundRequest']);
        Route::post('review', ['as' => 'review', 'uses' => 'OrderController@addReview']);
        Route::get('active/{id}',     ['as' => 'take.single', 'uses' => 'OrderController@activeOrder']); // Single Order by User

    });

    Route::group(['as'=>'contact.','prefix'=>'contact','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('request', ['as' => 'contact', 'uses' => 'FranchiseController@contact']);
    });
    Route::group(['as'=>'token.','prefix'=>'token','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::post('update', ['as' => 'token', 'uses' => 'UserController@tokenUpdate']);
    });
    Route::group(['as'=>'deals.','prefix'=>'deals','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('all/{id?}', ['as' => 'index', 'uses' => 'DealsController@deals']);
    });

    Route::group(['as'=>'faq.','prefix'=>'faq','namespace'=>'App\Http\Controllers\Api'], function () {
        Route::get('all', ['as' => 'index', 'uses' => 'FaqController@index']);
    });




// Route::group(['as'=> 'admin.','prefix'=>'admin','middleware' => ['auth','admin','role:admin'],'namespace'=>'App\Http\Controllers\Admin'], function () {
