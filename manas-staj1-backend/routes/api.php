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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::group(['namespace' => 'Product', 'prefix' => 'products'], function(){
        Route::get('/', 'IndexController');
        Route::post('/', 'StoreController');
        Route::get('/{product}', 'EditController');
        Route::patch('/{product}', 'UpdateController');
        Route::delete('/{product}', 'DeleteController');
    });
    Route::group(['namespace' => 'Order', 'prefix' => 'orders'], function (){
        Route::delete('/{order}', 'DeleteController');
        Route::get('/index', 'IndexController');
        Route::get('/status/{order}', 'StatusController');
    });
});

Route::group(['namespace' => 'User', 'prefix' => 'user'], function(){
    Route::post('/register', 'RegisterController');
    Route::post('/login', 'LoginController');
    Route::get('/logout', 'LogoutController');
});
Route::group(['middleware' => 'user'], function(){
    Route::post('/order', 'OrderController');
    Route::get('/products', 'HomeController');
    Route::get('/top/five', 'TopFiveController');
    Route::post('/search', 'SearchController');
    Route::get('/status/order', 'OrderStatusController');
});


// oreder

// Route::post('/order', 'OrderController');

