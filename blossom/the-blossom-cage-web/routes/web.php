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
Route::any('sns-topic/email-response', 'HomeController@emailResponse')->name('emailResponse');

Route::get('locale', 'HomeController@changeLocale')->name('changeLocale');
Route::get('localeCurrentValue', 'HomeController@localeCurrentValue')->name('localeCurrentValue');
Route::post('sns-topic/email-response', 'HomeController@emailResponse');
//Route::get('rocketapi', 'HomeController@rocketapi');
Route::get('currency', 'HomeController@changeCurrency')->name('changeCurrency');
Route::get('apple-app-site-association', 'OrdersController@jsonFile');
Route::get('refresh-csrf', function(){ return csrf_token(); });

Route::prefix('{lang?}')->middleware('locale')->group(function() {

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
    Route::get('/privacy', function () {
        return view('privacy');
    })->name('privacy');

    Route::get('/delivery', function () {
        return view('delivery');
    })->name('delivery');
    Route::get('/faq', function () {
        return view('faq');
    })->name('faq');
    Route::get('/payment', function () {
        return view('payment');
    })->name('payment');
    Route::get('/store', function () {
        return view('store');
    })->name('store');

    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');

    Route::any('/', 'HomeController@index')->name('home');
    Route::get('about', 'HomeController@about')->name('about');

    Route::group(['prefix' => 'product'], function() {
        Route::get('/{slug}', 'ItemsController@itemDetails')->name('itemDeatils');
    });

    Route::group(['prefix' => 'products'], function() {
        Route::get('/{query?}', 'ItemsController@filterItems')->name('searchItem');
        Route::get('/featured/list', 'ItemsController@getFeaturedItem')->name('getFeaturedItems');
    });

    Route::group(['prefix' => 'cart'], function() {
        Route::get('/', 'CartController@index')->name('viewBag');
        Route::post('store', 'CartController@store')->name('addToShopingBag');
        Route::post('storeupdateitem', 'CartController@storeupdateitem')->name('addToShopingBagUpdate');
        Route::post('itemeditcolor', 'CartController@getItemEditColor')->name('itemeditcolor');
        Route::post('update', 'CartController@update')->name('updateShoppingbag');
        Route::delete('delete', 'CartController@delete')->name('deleteFromShoppingbag');
        Route::delete('deleteAccessories', 'CartController@deleteAccessories')->name('deleteAccessoiresFromShoppingbag');
        Route::get('get', 'CartController@getCartData')->name('getShoppingbag');
    });

    Route::group(['prefix' => 'checkout'], function() {
        Route::get('/', 'OrdersController@showCheckout')->name('checkout');
    });

    Route::group(['prefix' => 'orders'], function() {

        Route::any('place', 'OrdersController@store')->name('placeOrder');
        Route::any('success', 'OrdersController@success')->name('orderSucess');
        Route::get('show/{uuid}', 'OrdersController@show')->name('orderDetails');
        Route::get('/', 'OrdersController@index')->name('myOrders')->middleware('auth_user');
    });

    Route::group(['prefix' => 'users'], function() {

        Route::post('signin', 'UsersController@signin')->name('signin');
        Route::post('signup', 'UsersController@signup')->name('signup');
        Route::get('logout', 'UsersController@logout')->name('logout')->middleware('auth_user');

        Route::group(['prefix' => 'password'], function() {

            Route::get('change', 'ProfileController@changePassword')->name('changePassword')->middleware('auth_user');
            Route::post('update', 'ProfileController@updatePassword')->name('updatePassword')->middleware('auth_user');
            Route::post('forgot', 'ProfileController@forgotPassword')->name('forgotPassword');
            Route::get('reset', 'ProfileController@resetPassword')->name('resetPassword');
            Route::post('reset/update', 'ProfileController@updatResetPassword')->name('updatResetPassword');
        });
        Route::group(['prefix' => 'profile'], function() {

            Route::get('/', 'ProfileController@index')->name('myProfile')->middleware('auth_user');
            Route::get('/address', 'ProfileController@address')->name('myAddress')->middleware('auth_user');
            Route::post('/update', 'ProfileController@update')->name('updateProfile')->middleware('auth_user');
            Route::post('/upload', 'ProfileController@profileImageUpload')->name('updateProfileImage')->middleware('auth_user');
        });
        Route::group(['prefix' => 'feedback'], function() {

            Route::get('/', 'FeedbackController@index')->name('feedback')->middleware('auth_user');
            Route::post('/store', 'FeedbackController@store')->name('storeFeedback')->middleware('auth_user');
        });
        Route::group(['prefix' => 'contact'], function() {
            Route::post('store', 'FeedbackController@contactStore')->name('contactStore');
        });
    });

    Route::group(['prefix' => 'wishlist'], function() {

        Route::get('/', 'FavoritesController@index')->name('myFavorites')->middleware('auth_user');
        Route::post('delete', 'FavoritesController@destroy')->name('removeFavorite')->middleware('auth_user');
        Route::post('store', 'FavoritesController@store')->name('addFavorite')->middleware('auth_user');
    });
});
