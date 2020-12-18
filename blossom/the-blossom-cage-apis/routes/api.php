<?php

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

Route::any('ipn/save', 'IpnController@saveIpnResponse')->name('ipnsave');
Route::post('sns-email-status-check', 'IpnController@emailResponse')->name('emailResponse');
Route::post('currency/convert', 'OrdersController@convertCurrency')->name('convertCurrency');


//Route::group(['middleware' => ['throttle']], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoriesController@index')->name('categoriesList');
    });
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', 'BrandsController@index')->name('brandsList');
    });
    Route::group(['prefix' => 'items'], function () {

        Route::get('/', 'ItemsController@index')->name('itemsList');
        Route::get('/{slug}', 'ItemsController@show')->name('itemShow');
        Route::get('/featured/list', 'ItemsController@getFeaturedItems');
        Route::post('/check/quantity', 'ItemsController@checkQuantity');
    });
    Route::group(['prefix' => 'homefeeds'], function () {
        Route::get('/', 'HomeFeedsController@index')->name('homefeedList');

    });

    Route::group(['prefix' => 'orders'], function () {

        Route::get('{type?}', 'OrdersController@index')->name('myOrder');
        Route::post('store', 'OrdersController@store')->name('palceOrder');
        Route::get('show/{uid}', 'OrdersController@show')->name('detailedOrder');
        Route::put('update', 'OrdersController@update')->name('updateOrder');
    });

    Route::group(['prefix' => 'users'], function () {

        Route::post('signupForGuest', 'UsersController@signupForGuest')->name('signupForGuest');
        
        Route::post('login', 'UsersController@login')->name('loginUser');
        Route::post('signup', 'UsersController@signup')->name('signupUser');
        Route::get('profile', 'ProfileController@index')->name('profileUser');
        Route::get('getCountryAndCityInformation', 'UsersController@getCountryAndCityInformation')->name('getCountryAndCityInformation');
        Route::post('profile/update', 'ProfileController@update')->name('profileUserUpdate');
        Route::post('profile/settings', 'ProfileController@settings')->name('profileSettings');
        Route::put('password/change', 'ProfileController@passwordUpdate')->name('passwordUpdate');
        Route::post('feedback/store', 'FeedbackController@store')->name('feedback');
    });

    Route::group(['prefix' => 'favorites'], function () {

        Route::post('store', 'FavoritesController@store')->name('makeFavorite');
        Route::get('index', 'FavoritesController@index')->name('getFavorites');
        Route::delete('delete/{uuid}', 'FavoritesController@destroy')->name('deleteFavorites');
    });

    Route::group(['prefix' => 'password'], function () {

        Route::post('forgot', 'ForgotpaswordController@index')->name('forgotPassword');
        Route::post('reset', 'ForgotpaswordController@resetPassword')->name('resetPassword');
    });
//});
