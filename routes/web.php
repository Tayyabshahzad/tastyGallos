<?php

use Illuminate\Support\Facades\Route;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('thanks',function(){
    return view('order-thanks');
});

Route::get('test',   ['as' => 'test','uses' => 'App\Http\Controllers\TestController@index2']);
Route::get('event-receive',   ['as' => 'test','uses' => 'App\Http\Controllers\TestController@index3']);
Route::get('test-token',   ['as' => 'send','uses' => 'App\Http\Controllers\TestController@send']);
//Route::get('clear-my-cache',   ['as' => 'clear-my-cache'        ,'uses' => 'App\Http\Controllers\Admin\UserController@clearMyCache']);


Route::get('getSound',   ['as' => 'get.sound','uses' => 'App\Http\Controllers\notificationController@sound']);
Route::get('manul-logOut',   ['as' => 'logOutUser'        ,'uses' => 'App\Http\Controllers\Admin\UserController@logOutUserManulally']);
Route::get('send',   ['as' => 'broadcast'        ,'uses' => 'App\Http\Controllers\UserController@send']);
Route::get('receive',['as' => 'broadcast.receive','uses' => 'App\Http\Controllers\UserController@receive']);
Route::post('store/token',['as' => 'store.token','uses' => 'App\Http\Controllers\notificationController@storeToken']);
Route::get('allow/notification',['as' => 'allow.notifications','uses' => 'App\Http\Controllers\notificationController@allow']);
Route::get('responce', ['as' => 'takeOrder.index','uses' => 'App\Http\Controllers\Api\OrderController@index']);
Route::post('responce', ['as' => 'takeOrder','uses' => 'App\Http\Controllers\Api\OrderController@take']);

Route::get('updateOrderNotification', ['as' => 'notification.mark','uses' => 'App\Http\Controllers\notificationController@markNotification']);
Route::group(['namespace'=>'App\Http\Controllers'], function () {
    Route::get('/', ['as' => 'basePath','uses' => 'UserController@login']);
    Route::get('update-password/{token}/{email}', ['as' => 'updatePassword','uses' => 'UserController@setNewPassword']);
    Route::post('update-password', ['as' => 'franchise.password.update','uses' => 'UserController@updatePassword']);
    Route::group(['middleware'=>'web'], function () {
        Route::get('redirect/github', ['as' => 'git.redirect','uses' => 'UserController@githubRedirect']);
        Route::get('callback/github', ['as' => 'git.callback','uses' => 'UserController@githubCallback']);
    });
    Route::get('redirect/google', ['as' => 'google.redirect','uses' => 'UserController@googleRedirect']);
    Route::get('callback/google', ['as' => 'google.callback','uses' => 'UserController@googleCallback']);
    Route::get('redirect/facebook', ['as' => 'facebook.redirect','uses' => 'UserController@facebookRedirect']);
    Route::get('callback/facebook', ['as' => 'facebook.callback','uses' => 'UserController@facebookCallback']);
    //Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
Route::group(['as'=> 'admin.','prefix'=>'admin','middleware' => ['auth','admin','role:admin'],'namespace'=>'App\Http\Controllers\Admin'], function () {
    Route::get('dashboard', ['as' => 'dashboard',           'uses' => 'HomeController@dashboard']);
    Route::get('franchise', ['as' => 'franchises',           'uses' => 'FranchiseController@index']);
    Route::get('franchises-datatable', ['as' => 'franchises.datatable',           'uses' => 'FranchiseController@anyData']);
    Route::get('franchise/create',['as' => 'franchises.create',    'uses' => 'FranchiseController@create']);
    Route::post('franchise/save',['as' => 'franchises.save',    'uses' => 'FranchiseController@save']);
    Route::get('franchises/edit/{id?}',['as' => 'franchises.edit',      'uses' => 'FranchiseController@edit']);
    Route::get('product/name',['as' => 'product.name',      'uses' => 'FranchiseController@getProduct']);
    Route::post('franchise/update',['as' => 'franchises.update',      'uses' => 'FranchiseController@update']);
    Route::post('franchise/delete',['as' => 'franchises.delete',      'uses' => 'FranchiseController@delete']);
    Route::post('franchise/update/password',['as' => 'franchise.password.update',      'uses' => 'FranchiseController@passwordReset']);
    Route::get('franchises/filter',['as' => 'franchise.get.review',      'uses' => 'FranchiseController@getReviews']);
    Route::get('franchises/review',['as' => 'franchise.review',      'uses' => 'FranchiseReviewController@getReviews']);
    Route::get('franchises/review/detail',['as' => 'franchise.review.detail',      'uses' => 'FranchiseReviewController@reviewDetail']);
    Route::get('franchises/review/filter',['as' => 'franchise.review.filter',      'uses' => 'FranchiseReviewController@filterReviews']);
    Route::get('franchises/order/filter',['as' => 'franchise.order.filter',      'uses' => 'FranchiseController@filterOrders']);
    Route::post('franchise/user/details',['as' => 'franchise.user.detail.get',      'uses' => 'FranchiseController@userDetail']);
    Route::get('franchise/orders/active',['as' => 'franchise.active.orders',      'uses' => 'FranchiseController@activeOrders']);
    Route::get('franchise/order/details',['as' => 'franchise.orders.detail',      'uses' => 'FranchiseController@orderDetails']);
    Route::get('franchise/order/all',['as' => 'franchise.orders.all',      'uses' => 'FranchiseController@allOrders']);
    Route::get('franchise/products',   ['as' => 'franchise.products',     'uses' => 'FranchiseController@products']);
    Route::post('franchise/special-price',   ['as' => 'franchise.set.specialPrice',     'uses' => 'FranchiseController@specialPrice']);
    Route::post('franchise/product-status',   ['as' => 'franchise.product.status',     'uses' => 'FranchiseController@productStatus']);
    Route::post('franchise/special-update',   ['as' => 'franchise.update.specialPrice',     'uses' => 'FranchiseController@updateSpecialPrice']);
    Route::post('franchise/product/remove/price',   ['as' => 'franchise.product.removePrice',     'uses' => 'FranchiseController@removePrice']);
    Route::get('franchise/orders/filter/active',   ['as' => 'franchise.filter.active.order',     'uses' => 'FranchiseController@activeOrderFilter']);
    Route::get('franchise/orders/modifiers',   ['as' => 'franchise.order.modifiers',     'uses' => 'FranchiseController@modifiers']);
    Route::get('franchise/orders/extras',   ['as' => 'franchise.order.extras',     'uses' => 'FranchiseController@orderExtras']);
    Route::get('franchise/orders/modifiers/items',   ['as' => 'franchise.order.modifiers.items',     'uses' => 'FranchiseController@modifiersItem']);
    Route::post('franchise/order/extras',   ['as' => 'franchise.bogo.',  'uses' => 'FranchiseController@orderExtras']);
    Route::post('franchise/order/bogo/modifier',   ['as' => 'franchise.orders.bogo.modifier',  'uses' => 'FranchiseController@orderBogoModifier']);
    Route::post('franchise/order/deal/extras',   ['as' => 'franchise.order.deal.extras',  'uses' => 'FranchiseController@orderDealExtra']);

    Route::get('categories', ['as' => 'categories',     'uses' => 'CategoryController@index']);
    Route::post('category/save',   ['as' => 'categories.store',     'uses' => 'CategoryController@store']);
    Route::post('category/update',     ['as' => 'categories.update','uses' => 'CategoryController@update']);
    Route::post('category/delete',     ['as' => 'categories.delete','uses' => 'CategoryController@delete']);
    Route::get('modifiers',  ['as' => 'modifiers',     'uses' => 'ModifiersController@index']);
    Route::get('modifiers/create',  ['as' => 'modifiers.create',     'uses' => 'ModifiersController@create']);
    Route::post('modifiers/store',  ['as' => 'modifiers.store',     'uses' => 'ModifiersController@store']);
    Route::get('modifiers/edit/{id?}',    ['as' => 'modifiers.edit','uses' => 'ModifiersController@edit']);
    Route::post('modifiers/edit/update',    ['as' => 'modifiers.update','uses' => 'ModifiersController@update']);
    Route::post('modifiers/item/update',    ['as' => 'modifiers.item.update','uses' => 'ModifiersController@singleItemUpdate']);
    Route::get('modifiers/item/delete',    ['as' => 'modifiers.item.delete','uses' => 'ModifiersController@singleItemDelete']);
    Route::post('modifiers/item/add',       ['as' => 'modifiers.item.add','uses' => 'ModifiersController@addItem']);
    Route::post('modifiers/delete',    ['as' => 'modifiers.delete','uses' => 'ModifiersController@delete']);
    Route::get('products',   ['as' => 'products',     'uses' => 'ProductController@index']);
    Route::get('products/create',    ['as' => 'products.create',     'uses' => 'ProductController@create']);
    Route::post('products/store',    ['as' => 'products.store',     'uses' => 'ProductController@store']);
    Route::get('products/edit/{id?}',      ['as' => 'products.edit','uses' => 'ProductController@edit']);
    Route::post('products/update',      ['as' => 'products.update','uses' => 'ProductController@update']);
    Route::post('products/delete',      ['as' => 'products.delete','uses' => 'ProductController@delete']);
    Route::get('products/photo/delete',      ['as' => 'products.photo.delete','uses' => 'ProductController@photoDelete']);
    Route::get('deals',      ['as' => 'deals.index','uses' => 'DealsController@index']);
    Route::get('deals/create',      ['as' => 'deals.create','uses' => 'DealsController@create']);
    Route::post('deals/store',      ['as' => 'deals.store','uses' => 'DealsController@store']);
    Route::get('deals/edit/{id?}',      ['as' => 'deals.edit','uses' => 'DealsController@edit']);
    Route::post('deals/update',      ['as' => 'deals.update','uses' => 'DealsController@update']);
    Route::post('deals/delete',      ['as' => 'deals.delete','uses' => 'DealsController@delete']);
    Route::get('deals/photo/delete',      ['as' => 'deals.photo.delete','uses' => 'DealsController@deletePhoto']);
    Route::post('deals/product/price',      ['as' => 'deals.get.product.price','uses' => 'DealsController@dealProductPrice']);
    Route::post('deals/remove/product',      ['as' => 'deals.remove.product','uses' => 'DealsController@removeProduct']);

    Route::get('extras',      ['as' => 'extras','uses' => 'ExtrasController@index']);
    Route::get('extras/create',      ['as' => 'extras.create','uses' => 'ExtrasController@create']);
    Route::post('extras/store',      ['as' => 'extras.store','uses' => 'ExtrasController@store']);
    Route::get('extras/edit/{id?}',      ['as' => 'extras.edit','uses' => 'ExtrasController@edit']);
    Route::post('extras/update',      ['as' => 'extras.update','uses' => 'ExtrasController@update']);
    Route::post('extras/delete',      ['as' => 'extras.delete','uses' => 'ExtrasController@delete']);
    Route::get('promotions', ['as' => 'promotions',   'uses' => 'PromotionController@index']);
    Route::get('promotions/view/{id?}', ['as' => 'promotions.view',   'uses' => 'PromotionController@view']);
    Route::get('promotions/create',  ['as' => 'promotions.create',   'uses' => 'PromotionController@create']);
    Route::post('promotions/store',  ['as' => 'promotions.store',   'uses' => 'PromotionController@store']);
    Route::get('promotions/edit/{id?}',    ['as' => 'promotions.edit',     'uses' => 'PromotionController@edit']);
    Route::post('promotions/inactive',    ['as' => 'promotions.inactive',     'uses' => 'PromotionController@inactive']);
    Route::post('promotions/delete',    ['as' => 'promotions.delete',     'uses' => 'PromotionController@delete']);
    Route::post('promotions/update',    ['as' => 'promotions.update',     'uses' => 'PromotionController@update']);
    Route::get('promotion/banners',    ['as' => 'promotions.banners',     'uses' => 'PromotionController@banners']);
    Route::post('promotion/banners/create',    ['as' => 'promotions.banners.create',     'uses' => 'PromotionController@bannersCreate']);
    Route::get('promotion/cancel',    ['as' => 'promotions.cancel',     'uses' => 'PromotionController@cancel']);
    Route::get('promotion/banners/delete',    ['as' => 'promotions.banners.delete',     'uses' => 'PromotionController@bannersDelete']);

    Route::get('payables',   ['as' => 'payables',     'uses' => 'PayableController@index']);
    //Route::post('payables/generate',   ['as' => 'payables.generate',     'uses' => 'PayableController@generate']);
    Route::get('payables/pay',   ['as' => 'payables.pay',     'uses' => 'PayableController@pay']);
    Route::get('invoice',   ['as' => 'invoice',     'uses' => 'InvoiceController@index']);
    Route::get('invoice/detail/{id}',   ['as' => 'invoice.detail',     'uses' => 'InvoiceController@detail']);
    Route::get('invoice/email/{id}',      ['as' => 'invoice.email','uses' => 'InvoiceController@email']);

    Route::get('sales',      ['as' => 'sales', 'uses' => 'SaleController@index']);
    Route::get('sales/generate',      ['as' => 'sales.generate', 'uses' => 'SaleController@generateSale']);
    Route::post('submit/manual/refund',      ['as' => 'manual.refund.submit', 'uses' => 'SaleController@submitRefund']);
    Route::post('sales/total',      ['as' => 'sales.getTotal', 'uses' => 'SaleController@getTotal']);
    Route::get('refunds',    ['as' => 'refunds',      'uses' => 'RefundController@index']);
    Route::get('refunds/user/details',    ['as' => 'refunds.userDetail',  'uses' => 'RefundController@getUsers']);
    Route::get('refunds/order/details',    ['as' => 'refunds.orderDetail', 'uses' => 'RefundController@orderDetail']);
    Route::get('refunds/issue',    ['as' => 'refunds.issue', 'uses' => 'RefundController@issueRefund']);
    Route::get('refunds/cancel',    ['as' => 'refunds.cancel', 'uses' => 'RefundController@cancelRefund']);
    Route::get('refunds/generate',      ['as' => 'refunds.generate', 'uses' => 'RefundController@generateRefund']);
    Route::get('refunds/status',    ['as' => 'refunds.status', 'uses' => 'RefundController@status']);
    Route::get('cms', ['as' => 'cms',   'uses' => 'CmsController@index']);
    Route::post('cms/faq', ['as' => 'faq.store',   'uses' => 'CmsController@faqStore']);
    Route::post('cms/update/faq', ['as' => 'faq.update',   'uses' => 'CmsController@faqUpdate']);
    Route::post('cms/update/delete', ['as' => 'faq.delete',   'uses' => 'CmsController@faqDelete']);
    Route::post('cms/option', ['as' => 'option.update',   'uses' => 'CmsController@optionUpdate']);
    Route::get('settings',   ['as' => 'settings',     'uses' => 'UserController@profile']);
    Route::post('settings/update',   ['as' => 'settings.update',     'uses' => 'UserController@update']);
    Route::post('settings/payfast',   ['as' => 'payfast.update',     'uses' => 'UserController@payFastUpdate']);
    Route::get('activity-logs',   ['as' => 'activityLog',     'uses' => 'ActivitylogController@index']);
    Route::get('users',   ['as' => 'users',  'uses' => 'UserController@index']);
    Route::get('users/edit/{id?}',   ['as' => 'users.edit',  'uses' => 'UserController@edit']);
    Route::post('users/update',   ['as' => 'user.update',  'uses' => 'UserController@update']);
    Route::post('users/delete',   ['as' => 'user.delete',  'uses' => 'UserController@delete']);
    Route::get('contact',   ['as' => 'contact',  'uses' => 'UserController@contact']);
    Route::post('contact/delete',   ['as' => 'contact.delete',  'uses' => 'UserController@contactDelete']);
});
Route::group(['as'=> 'admin.','prefix'=>'admin','middleware' => ['auth','admin','role:admin'],'namespace'=>'Rap2hpoutre\LaravelLogViewer'], function () {
    Route::get('logs',   ['as' => 'errors',     'uses' => 'LogViewerController@index']);
});
Route::group(['as'=> 'franchise.','prefix'=>'franchise','middleware' => ['auth','franchise','role:franchise'],'namespace'=>'App\Http\Controllers\Franchise'], function () {
    Route::get('dashboard',  ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);
    Route::get('real-time-dashboard',  ['as' => 'dashboard.realTime', 'uses' => 'HomeController@realTimeDashboard']);
    Route::post('filter',  ['as' => 'order.filter', 'uses' => 'HomeController@orderFilter']);
    Route::get('orders',     ['as' => 'orders',    'uses' => 'FranchiseController@orders']);
    Route::get('order/detail', ['as' => 'order.detail',    'uses' => 'FranchiseController@orderDetail']);
    Route::get('order/detail/status', ['as' => 'order.status',    'uses' => 'FranchiseController@changeOrderStatus']);
    Route::get('products',   ['as' => 'products',  'uses' => 'ProductController@products']);
    Route::get('earnings',         ['as' => 'earnings',  'uses' => 'EarningsController@index']);
    Route::get('earnings/details/{id?}', ['as' => 'earnings.detail',   'uses' => 'EarningsController@details']);
   // Route::get('earnings/email/{id}',      ['as' => 'earnings.email','uses' => 'InvoiceController@email']);
    Route::get('refunds',     ['as' => 'refunds',   'uses' => 'RefundController@index']);
    Route::get('refunds/create',     ['as' => 'refunds.create',    'uses' => 'RefundController@create']);
    Route::get('refunds/search',     ['as' => 'refunds.search',    'uses' => 'RefundController@search']);
    Route::get('refunds/order/details',     ['as' => 'refunds.order.details',    'uses' => 'RefundController@orderDetails']);
    Route::post('refunds/request/save',     ['as' => 'refunds.request.save',    'uses' => 'RefundController@save']);
    Route::get('refunds/detail',     ['as' => 'refund.detail',    'uses' => 'RefundController@refundOrderDetail']);
    Route::get('refunds/delete',     ['as' => 'refund.delete',    'uses' => 'RefundController@delete']);
    Route::get('information',   ['as' => 'information',  'uses' => 'InformationController@index']);
    Route::post('information/update',   ['as' => 'information.update',  'uses' => 'InformationController@update']);
    Route::get('settings/update',   ['as' => 'settings.update',  'uses' => 'UserController@update']);
    Route::get('profile',   ['as' => 'profile',  'uses' => 'InformationController@profile']);
    Route::post('profile/update',   ['as' => 'profile.update',  'uses' => 'InformationController@profileUpdate']);
    Route::get('order/cancel',   ['as' => 'order.cancel',  'uses' => 'FranchiseController@orderCancel']);
    Route::get('order/chnage/state',   ['as' => 'order.change.state',  'uses' => 'FranchiseController@changeOrderState']);
    Route::post('order/bogo/extras',   ['as' => 'orders.bogo.extras',  'uses' => 'FranchiseController@orderExtras']);
    Route::post('order/bogo/modifiers',   ['as' => 'orders.bogo.modifiers',  'uses' => 'FranchiseController@orderBogoModifier']);


});
require __DIR__.'/auth.php';
