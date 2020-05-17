<?php

use Illuminate\Support\Facades\Route;

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

Route::fallback(function () {
    return view('errors/404');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'address'], function () {
        Route::get('/index', 'AddressManageController@index')->name('addressIndex');
        Route::get('/add', 'AddressManageController@addView')->name('addAddressView');
        Route::post('/store/{id?}', 'AddressManageController@store')->name('storeAddress');
        Route::get('/edit/{id}', 'AddressManageController@editView')->name('editAddressView');
        Route::post('/delete/{id}', 'AddressManageController@delete')->name('deleteAddress');
    });

    Route::group(['prefix' => 'my'], function () {
        Route::get('/', 'UserController@index')->name('myDetails');
        Route::get('/edit', 'UserController@editView')->name('editMyDetails');
        Route::post('/store/{id?}', 'UserController@store')->name('storeDetail');
    });
});
