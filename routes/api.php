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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/login', 'Auth\Store\StoreAuthApiController@login');
Route::post('/customer/login/','Auth\Customer\CustomerAuthApiController@login');
Route::post('/customer/register/','Auth\Customer\CustomerAuthApiController@register');


Route::group(['middleware' => ['auth:api']], function () {
    // store
    Route::post('/store/view', 'API\StoreController@view');
    Route::post('/store/update', 'API\StoreController@update');
    // orders


    Route::post('store/orders/view', 'API\StoreController@orders_view');
    Route::post('store/order/view/details', 'API\StoreController@orders_view_details');
    Route::post('store/order/update/status', 'API\StoreController@update_order_status');
    
    //New AAL
    Route::post('store/order/create', 'WEBAPI\OrderController@create');

    // category
    Route::post('/store/category/add', 'API\CategoryController@create');
    Route::post('/store/category/view', 'API\CategoryController@fetch');
    Route::post('/store/category/update', 'API\CategoryController@update');

    // product



    Route::post('/store/product/create', 'API\ProductController@create');
    Route::post('store/product/view', 'API\ProductController@fetch');
    Route::post('store/product/update', 'API\ProductController@update');

    // save notification token

    Route::post('store/update/firebase/token', 'API\ServiceController@save_store_fcm_token');

});

Route::prefix('/web/store/')
    ->group(function () {
        Route::post('/fetch', 'WEBAPI\StoreController@fetch');
        Route::post('/create/order', 'WEBAPI\OrderController@create');
        Route::post('/account/orders', 'WEBAPI\OrderController@fetch');
        Route::post('/waiter/call', 'WEBAPI\StoreController@calling_waiter');
        Route::post('/translation/active', 'WEBAPI\StoreController@translation');
        Route::post('/translations', 'WEBAPI\StoreController@all_translation');

        Route::post('/checkout/payment', 'WEBAPI\PaymentController@processPayment');
        Route::post('/coupon/add', 'WEBAPI\StoreController@verify_coupon');

    });




