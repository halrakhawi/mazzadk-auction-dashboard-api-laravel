<?php

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

//Route::get('/', function () {
  //  return view('welcome');
//});


Route::get('/admin/login','Auth\AdminLoginController@showloginform')->name('login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin','AdminController@index')->name('admin');
//Route::post('/logout', 'Auth\AdminLoginController@logout')->name('logout');
Route::post('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/admin/login");
})->name('logout');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('admin', 'Admin\AdminController@index');
//Route::resource('admin/roles', 'Admin\RolesController');
//Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::group(['middleware' => 'auth'], function() {
Route::resource('admin/users', 'UsersController');
Route::resource('admin/admin', 'AdminWebController');
Route::resource('admin/category', 'CategoryWebController');
Route::resource('admin/auction', 'auctionWebController');
Route::resource('admin/bid', 'BidWebController');
Route::resource('admin/product', 'ProductWebController');
Route::post('admin/product', 'ProductWebController@store')->name('picture');
Route::resource('admin/vedio', 'VRController');
Route::post('admin/vedio', 'VRController@update')->name('addvedio');


//Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
//Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});