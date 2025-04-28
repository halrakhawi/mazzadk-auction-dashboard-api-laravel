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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('signup', 'RegisterController@register');
Route::post('addFav', 'RegisterController@addTofav');
Route::get('getFav', 'RegisterController@getFav');

  // routes/api.php    

Route::post('loggin', 'AuthController@auth');
Route::post('address', 'RegisterController@address');
Route::get('getaddress', 'RegisterController@getaddress');
Route::get('profile', 'RegisterController@profile');
Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'ProductController')->except('show');
    Route::get('/product/{id}', 'ProductController@show');
    Route::get('/products/feature', 'ProductController@feature');
    Route::get('/products/best', 'ProductController@best');
    Route::resource('cart', 'CartController')->except('update');

});

Route::resource('category', 'categorycontroller');
Route::resource('auction', 'auctionController');
Route::resource('bid', 'BidController');
Route::get('mybiddings', 'BidController@mybiddings');
Route::get('/win/{id}', 'BidController@winnerbid');
Route::post('/cart/{cart}', 'CartController@addProducts');
Route::post('/cart/{cart}/checkout', 'CartController@checkout');

