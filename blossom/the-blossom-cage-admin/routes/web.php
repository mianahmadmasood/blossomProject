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

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/employee', 'EmployeesController@welcome')->name('employeeLogin');
Route::post('login', 'EmployeesController@login')->name('employeeDoLogin');

Route::get('/error', function () {
    return view('errors.exceptions');
})->name('error');

Route::group(['prefix' => 'administrator'], function() {
    Route::post('login', 'LoginController@login')->name('adminLogin');
    Route::get('signout', 'LoginController@signout')->name('signout');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware(['admin','auth'] );
Route::get('/updateCountryCity', 'HomeController@updateCountryCity');
Route::get('/updatelogStatus', 'HomeController@updatelogStatus');
Route::get('/updatesalePrice', 'HomeController@updatesalePrice');



Route::group(['prefix' => 'employee' , 'middleware' => ['auth']], function() {

    Route::get('block/{id}/{string}', 'EmployeesController@destroy')->name('blockEmployee')->middleware('admin');
    Route::post('update', 'EmployeesController@update')->name('updateEmployee')->middleware('admin');
    Route::get('create', 'EmployeesController@create')->name('createEmployee')->middleware('admin');
    Route::get('edit/{id}', 'EmployeesController@edit')->name('editEmployee')->middleware('admin');
    Route::post('store', 'EmployeesController@store')->name('storeEmployee')->middleware('admin');
    Route::get('index', 'EmployeesController@index')->name('allEmployees')->middleware('admin');
    Route::post('image-upload', 'EmployeesController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('orders/{id}', 'EmployeesController@show')->name('showEmployees')->middleware('admin');
    Route::get('dashboard', 'EmployeesController@dashboard')->name('employeeDashboard')->middleware('employee');
});
Route::group(['prefix' => 'customer' , 'middleware' => ['auth']], function() {
    Route::get('block/{id}/{string}', 'CustomersController@destroy')->name('blockCustomer')->middleware('admin');
     Route::get('index', 'CustomersController@index')->name('allCustomers')->middleware('admin');
     Route::get('indexForbug', 'CustomersController@indexForbug')->name('indexForbug')->middleware('admin');
    Route::get('orders/{id}/{type}', 'CustomersController@show')->name('showCustomers')->middleware('admin');
    Route::post('orders_type', 'CustomersController@showOrderType')->name('showCustomersOrdertype')->middleware('admin');

});

Route::group(['prefix' => 'categories' , 'middleware' => ['auth']], function() {

    Route::get('create', 'CategoriesController@create')->name('createCategory')->middleware('admin');
    Route::post('store', 'CategoriesController@store')->name('storeCategory')->middleware('admin');
    Route::get('index', 'CategoriesController@index')->name('getCategories')->middleware('admin');
    Route::post('image-upload', 'CategoriesController@addImg')->name('uploadImage')->middleware('admin');
    Route::post('icon-categories-image-upload', 'CategoriesController@addImgIconCategories')->name('uploadiconCategoriesImage')->middleware('admin');
    Route::get('items/{uuid}', 'ItemsController@categoryItems')->name('getCategoryItems')->middleware('admin');
    Route::get('deleted', 'CategoriesController@deleted')->name('getArchivedCategories')->middleware('admin');
    Route::get('edit/{uid}', 'CategoriesController@edit')->name('editCategory')->middleware('admin');
    Route::post('update', 'CategoriesController@update')->name('updateCategory')->middleware('admin');
    Route::get('state/{uid}/{status}', 'CategoriesController@destroy')->name('updateStatusCategory')->middleware('admin');
});

Route::group(['prefix' => 'sub-categories' , 'middleware' => ['auth']], function() {

    Route::get('create', 'SubCategoriesController@create')->name('createSubCategory')->middleware('admin');
    Route::post('store', 'SubCategoriesController@store')->name('storeSubCategory')->middleware('admin');
    Route::post('image-upload', 'SubCategoriesController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('index', 'SubCategoriesController@index')->name('getSubCategories')->middleware('admin');
    Route::get('edit/{uid}', 'SubCategoriesController@edit')->name('editSubCategory')->middleware('admin');
    Route::post('update', 'SubCategoriesController@update')->name('updateSubCategory')->middleware('admin');
    Route::get('ajax/{id}', 'SubCategoriesController@ajaxCall')->name('ajaxIndex')->middleware('admin');
    Route::get('deleted', 'SubCategoriesController@deleted')->name('getArchivedSubCategories')->middleware('admin');
    Route::get('state/{uid}/{status}', 'SubCategoriesController@destroy')->name('updateStatusSubCategory')->middleware('admin');


});
Route::group(['prefix' => 'brands' , 'middleware' => ['auth']], function() {

    Route::get('create', 'BrandsController@create')->name('createbrand')->middleware('admin');
    Route::post('store', 'BrandsController@store')->name('storebrand')->middleware('admin');
    Route::post('image-upload', 'BrandsController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('index', 'BrandsController@index')->name('getBrands')->middleware('admin');
    Route::get('edit/{uid}', 'BrandsController@edit')->name('editBrand')->middleware('admin');
    Route::post('update', 'BrandsController@update')->name('updateBrand')->middleware('admin');
    Route::get('archive/{uid}/{status}', 'BrandsController@destroy')->name('updateArchiveBrand')->middleware('admin');
    Route::get('state/{uid}/{status}', 'BrandsController@statusdestroy')->name('updateStatusBrand')->middleware('admin');
    Route::get('deleted', 'BrandsController@deleted')->name('getDeletedBrands')->middleware('admin');

});
Route::group(['prefix' => 'TrendyItem' , 'middleware' => ['auth']], function() {

    Route::get('create', 'HomeFeedsController@create')->name('createTrendyItem')->middleware('admin');
    Route::post('store', 'HomeFeedsController@storeTrendyItem')->name('storeTrendyItem')->middleware('admin');
    Route::post('image-upload', 'HomeFeedsController@addImg')->name('uploadImage')->middleware('admin');
    Route::post('position', 'HomeFeedsController@OrderChange')->name('TrendyItemOrderChange')->middleware('admin');
    Route::get('index', 'HomeFeedsController@indexTrendyItems')->name('getTrendyItems')->middleware('admin');
    Route::get('edit/{uid}', 'HomeFeedsController@edit')->name('editTrendyItem')->middleware('admin');
    Route::post('update', 'HomeFeedsController@update')->name('updateTrendyItem')->middleware('admin');
    Route::get('archive/{uid}/{status}/{type}', 'HomeFeedsController@updateArchiveTrendyItem')->name('updateArchiveTrendyItem')->middleware('admin');
    Route::get('state/{uid}/{status}/{type}', 'HomeFeedsController@statusdestroy')->name('updateStatusTrendyItem')->middleware('admin');
    Route::get('deleted', 'HomeFeedsController@deleted')->name('getDeletedTrendyItems')->middleware('admin');
    Route::get('ajax/{id}', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');
    Route::post('ajaxCall', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');

});


Route::group(['prefix' => 'banners' , 'middleware' => ['auth']], function() {

    Route::get('create', 'HomeFeedsController@create')->name('createbanner')->middleware('admin');
    Route::post('store', 'HomeFeedsController@store')->name('storebanner')->middleware('admin');
    Route::post('image-upload', 'HomeFeedsController@addImg')->name('uploadImage')->middleware('admin');
    Route::post('position', 'HomeFeedsController@OrderChange')->name('bannerOrderChange')->middleware('admin');
    Route::get('index', 'HomeFeedsController@index')->name('getBanners')->middleware('admin');
    Route::get('edit/{uid}', 'HomeFeedsController@edit')->name('editBanner')->middleware('admin');
    Route::post('update', 'HomeFeedsController@update')->name('updateBanner')->middleware('admin');
    Route::get('archive/{uid}/{status}/{type}', 'HomeFeedsController@destroy')->name('updateArchiveBanner')->middleware('admin');
    Route::get('state/{uid}/{status}/{type}', 'HomeFeedsController@statusdestroy')->name('updateStatusBanner')->middleware('admin');
    Route::get('deleted', 'HomeFeedsController@deleted')->name('getDeletedBanners')->middleware('admin');
    Route::get('ajax/{id}', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');
    Route::post('ajaxCall', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');

});

Route::group(['prefix' => 'topBrands' , 'middleware' => ['auth']], function() {

    Route::get('index', 'HomeFeedsController@indextopBrands')->name('gettopBrands')->middleware('admin');
    Route::get('create', 'HomeFeedsController@create')->name('createbanner')->middleware('admin');
    Route::post('store', 'HomeFeedsController@storetopbrands')->name('storetopbrands')->middleware('admin');
    Route::post('image-upload', 'HomeFeedsController@addImg')->name('uploadImage')->middleware('admin');
    Route::post('position', 'HomeFeedsController@OrderChange')->name('bannerOrderChange')->middleware('admin');
    Route::get('edit/{uid}', 'HomeFeedsController@edit')->name('editBanner')->middleware('admin');
    Route::post('update', 'HomeFeedsController@update')->name('updateBanner')->middleware('admin');
    Route::get('archive/{uid}/{status}/{type}', 'HomeFeedsController@destroy')->name('updateArchiveBanner')->middleware('admin');
    Route::get('state/{uid}/{status}/{type}', 'HomeFeedsController@statusdestroy')->name('updateStatusBanner')->middleware('admin');
    Route::get('deleted', 'HomeFeedsController@deleted')->name('getDeletedBanners')->middleware('admin');
    Route::get('ajax/{id}', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');
    Route::post('ajaxCall', 'HomeFeedsController@ajaxCallForitem')->name('ajaxCallForitem')->middleware('admin');

});
Route::group(['prefix' => 'topSaleProduct' , 'middleware' => ['auth']], function() {

    Route::post('storetopSaleProduct', 'HomeFeedsController@storetopSaleProduct')->name('storetopSaleProduct')->middleware('admin');
    Route::post('position', 'HomeFeedsController@OrderChange')->name('bannerOrderChange')->middleware('admin');
    Route::get('index', 'HomeFeedsController@indexTopSaleItem')->name('gettopSaleProduct')->middleware('admin');
     Route::get('archive/{uid}/{status}/{type}', 'HomeFeedsController@destroy')->name('updateArchiveBanner')->middleware('admin');
    Route::get('state/{uid}/{status}/{type}', 'HomeFeedsController@statusdestroy')->name('updateStatusBanner')->middleware('admin');
    Route::get('ajax/{id}', 'HomeFeedsController@ajaxCallFortopSaleitem')->name('ajaxCallFortopSaleitem')->middleware('admin');
});
Route::group(['prefix' => 'falshDeals' , 'middleware' => ['auth']], function() {
    Route::post('storefalshDeals', 'HomeFeedsController@storefalshDeals')->name('storefalshDeals')->middleware('admin');
    Route::get('index', 'HomeFeedsController@indexfalshDeals')->name('getfalshDeals')->middleware('admin');
});
Route::group(['prefix' => 'topCategories' , 'middleware' => ['auth']], function() {
    Route::post('storetopCategories_1', 'HomeFeedsController@storetopCategories')->name('storetopCategories_1')->middleware('admin');
    Route::post('storetopCategories_2', 'HomeFeedsController@storetopCategories')->name('storetopCategories_2')->middleware('admin');
    Route::post('storetopCategories_3', 'HomeFeedsController@storetopCategories')->name('storetopCategories_3')->middleware('admin');
    Route::post('storetopCategories_4', 'HomeFeedsController@storetopCategories')->name('storetopCategories_4')->middleware('admin');
    Route::get('index', 'HomeFeedsController@indextopCategories')->name('gettopCategories')->middleware('admin');
    Route::post('ajaxCall', 'HomeFeedsController@ajaxCalltopCategoryItems')->name('ajaxCalltopCategoryItem')->middleware('admin');

});
Route::group(['prefix' => 'accessories' , 'middleware' => ['auth']], function() {

    Route::get('create', 'AccessoriesController@create')->name('createaccessorie')->middleware('admin');
    Route::post('store', 'AccessoriesController@store')->name('storeaccessorie')->middleware('admin');
    Route::post('image-upload', 'AccessoriesController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('index', 'AccessoriesController@index')->name('getAccessories')->middleware('admin');
    Route::get('edit/{uid}', 'AccessoriesController@edit')->name('editAccessorie')->middleware('admin');
    Route::post('update', 'AccessoriesController@update')->name('updateAccessorie')->middleware('admin');
    Route::get('archive/{uid}/{status}', 'AccessoriesController@destroy')->name('updateArchiveAccessorie')->middleware('admin');
    Route::get('state/{uid}/{status}', 'AccessoriesController@statusdestroy')->name('updateStatusAccessorie')->middleware('admin');
    Route::get('deleted', 'AccessoriesController@deleted')->name('getDeletedAccessories')->middleware('admin');

});

Route::group(['prefix' => 'colors' , 'middleware' => ['auth']], function() {

    Route::get('create', 'ColorsController@create')->name('createcolor')->middleware('admin');
    Route::post('store', 'ColorsController@store')->name('storecolor')->middleware('admin');
    Route::post('image-upload', 'ColorsController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('index', 'ColorsController@index')->name('getColors')->middleware('admin');
    Route::get('editColorOnly/{uid}', 'ColorsController@edit')->name('editColorOnly')->middleware('admin');
    Route::post('update', 'ColorsController@update')->name('updateColor')->middleware('admin');
    Route::get('archive/{uid}/{status}', 'ColorsController@destroy')->name('updateArchiveColor')->middleware('admin');
    Route::get('state/{uid}/{status}', 'ColorsController@statusdestroy')->name('updateStatusColor')->middleware('admin');
    Route::get('deleted', 'ColorsController@deleted')->name('getDeletedColors')->middleware('admin');

});

Route::group(['prefix' => 'warehouse' , 'middleware' => ['auth']], function() {

    Route::get('create', 'WarehousesController@create')->name('createWarehouse')->middleware('admin');
    Route::post('store', 'WarehousesController@store')->name('storeWarehouse')->middleware('admin');
    Route::get('index', 'WarehousesController@index')->name('getWarehouses')->middleware('admin');
    Route::get('deleted', 'WarehousesController@deleted')->name('getArchivedWarehouses')->middleware('admin');
    Route::get('edit/{uid}', 'WarehousesController@edit')->name('editWarehouse')->middleware('admin');
    Route::post('update', 'WarehousesController@update')->name('updateWarehouse')->middleware('admin');
    Route::post('image-upload', 'WarehousesController@addImg')->name('uploadImage')->middleware('admin');
    Route::get('state/{uid}/{status}', 'WarehousesController@destroy')->name('updateStatusWarehouse')->middleware('admin');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {

    Route::get('profile', 'ProfileController@index')->name('userProfile')->middleware('auth');
    Route::post('profile/update', 'ProfileController@update')->name('userProfileUpate')->middleware('auth');
    Route::get('password/change', 'ProfileController@changePassword')->name('userPasswordUpate')->middleware('auth');
    Route::post('password/update', 'ProfileController@updatePassword')->name('passwordUpate')->middleware('auth');
});

Route::group(['prefix' => 'product' , 'middleware' => ['auth']], function() {

//    Route::get('indexitemcoloradd', 'ItemsController@indexitemcoloradd')->name('indexitemcoloradd')->middleware('admin');

    Route::get('create', 'ItemsController@create')->name('createItem')->middleware('admin');
    Route::post('store', 'ItemsController@store')->name('storeItem');
    Route::post('image-upload', 'ItemImagesController@addImg')->name('uploadImage');
    Route::get('approved/all', 'ItemsController@index')->name('allItem');
    Route::get('deleted/all', 'ItemsController@deleted')->name('allDeletedItem');
    Route::get('pending/all', 'ItemsController@pending')->name('allPendingItem')->middleware('admin');
    Route::get('outofstock/all', 'ItemsController@outofstock')->name('allOutOfStock')->middleware('admin');
    Route::get('show/{uid}', 'ItemsController@show')->name('showItem')->middleware('admin');
    Route::get('edit/{uid}', 'ItemsController@edit')->name('editItem')->middleware('admin');
    Route::get('featured/{key}/{uid}', 'ItemsController@makeFeatured')->name('makeFeatured')->middleware('admin');
    Route::get('removed/{key}/{uid}', 'ItemsController@removed')->name('removed')->middleware('admin');
    Route::post('update', 'ItemsController@update')->name('updateItem')->middleware('admin');
    Route::get('status/{key}/{uid}', 'ItemsController@changeStatus')->name('changeItemStatus')->middleware('admin');


    Route::group(['prefix' => 'specifications'], function() {
        Route::get('add/{uid}', 'SpecificationsController@create')->name('createItemSpecs')->middleware('admin');
        Route::post('store', 'SpecificationsController@store')->name('storeItemSpecs')->middleware('admin');
        Route::get('edit/{uid}', 'SpecificationsController@edit')->name('editItemSpecs')->middleware('admin');
        Route::post('update', 'SpecificationsController@update')->name('updateItemSpecs')->middleware('admin');
    });

    Route::group(['prefix' => 'images'], function() {

        Route::get('status/{uid}/{status}', 'ItemImagesController@status')->name('imageStatus')->middleware('admin');
        Route::post('update', 'ItemImagesController@update')->name('updateImage')->middleware('admin');
        Route::get('create/{uid}', 'ItemImagesController@create')->name('createImage')->middleware('admin');
        Route::post('store', 'ItemImagesController@store')->name('storeImage')->middleware('admin');
        Route::get('edit/{uid}', 'ItemImagesController@edit')->name('editImage')->middleware('admin');
    });


    Route::group(['prefix' => 'variants', 'middleware' => ['admin']], function() {

        Route::post('itemcolorsingledelete', 'ItemsController@itemColorSingleDelete')->middleware('admin');
        Route::post('itemcolorsingleupdate', 'ItemsController@itemColorSingleUpdate')->middleware('admin');
        Route::get('addcolor/{uid}/{page?}', 'ItemsController@addcolors')->name('addcolor')->middleware('admin');
        Route::post('storeItemColorData', 'ItemsController@storeItemColorData')->name('storeItemColorData')->middleware('admin');
        Route::get('editColor/{uid}', 'ItemsController@editColor')->name('editColor')->middleware('admin');
        Route::post('updateItemColor', 'ItemsController@updateItemColor')->name('updateItemColor')->middleware('admin');
        Route::get('itemColorarchive/{uid}/{item_id}/{status}', 'ItemsController@destroyitemColor')->name('updateArchiveItemColor')->middleware('admin');

        Route::post('itemColorPartialsViewCall', 'ItemsController@itemColorPartialsViewCall')->name('itemColorPartialsViewCall')->middleware('admin');


        Route::get('create/{uid}/{page?}', 'ItemsController@createVariants')->name('createVairants')->middleware('admin');
        Route::post('store', 'ItemsController@storeVariantsData')->name('storeVariantsData')->middleware('admin');


        Route::get('edit/{uid}', 'ItemsController@editVariant')->name('editVariant')->middleware('admin');
        Route::post('update', 'ItemsController@updateVariant')->name('updateVariant')->middleware('admin');
        Route::post('image-upload', 'ItemsController@addImgColor')->name('uploadImage')->middleware('admin');
    });
    Route::group(['prefix' => 'techSpecs', 'middleware' => ['admin']], function() {

        Route::get('create/{uid}/{page?}', 'ItemsController@createTechSpec')->name('createTechSpec')->middleware('admin');
        Route::post('store', 'ItemsController@storeTechSpecData')->name('storeTechSpecData')->middleware('admin');
        Route::get('edit/{uid}', 'ItemsController@editTechSpec')->name('editTechSpec')->middleware('admin');
        Route::post('update', 'ItemsController@updateTechSpec')->name('updateTechSpec')->middleware('admin');
        Route::post('deleteTechSpec', 'ItemsController@deleteTechSpec')->name('deleteTechSpec')->middleware('admin');
    });
    Route::group(['prefix' => 'accessories', 'middleware' => ['admin']], function() {
        Route::post('store', 'ItemsController@storeItemAccessories')->name('storeItemAccessories')->middleware('admin');
        Route::get('delete/{uid}/{status}post', 'ItemsController@updateStatusitemAccessorie')->name('updateStatusitemAccessorie')->middleware('admin');
    });


    Route::group(['prefix' => 'meta-data'], function() {

        Route::get('create/{uuid}/{vuid?}', 'ItemsController@createMetaData')->name('createMetaData')->middleware('admin');
        Route::get('video/add/{uid}', 'ItemsController@addVideoLink')->name('addVideo')->middleware('admin');
        Route::post('video/store', 'ItemsController@storeVideoLink')->name('storeVideo')->middleware('admin');
        Route::get('manual/add/{uid}', 'ItemsController@addManual')->name('addManual')->middleware('admin');
        Route::post('manual/store', 'ItemsController@storeManual')->name('storeManual')->middleware('admin');
        Route::get('manual/add/{uid}', 'ItemsController@addManual')->name('addManual')->middleware('admin');
        Route::post('store', 'ItemsController@storeMeataData')->name('storeMeataData')->middleware('admin');
        Route::get('edit/{uid}', 'ItemsController@editMetaData')->name('editMetaData')->middleware('admin');
        Route::get('edit/manual/{uid}', 'ItemsController@editManual')->name('editManual')->middleware('admin');
        Route::post('update/manual', 'ItemsController@updateManual')->name('updateManual')->middleware('admin');
        Route::get('edit/video/{uid}', 'ItemsController@editVideo')->name('editVideo')->middleware('admin');
        Route::post('update/video', 'ItemsController@updateVideo')->name('updateVideo')->middleware('admin');
    });
});
Route::group(['prefix' => 'orders', 'middleware' => ['auth']], function() {

    Route::get('/{type}', 'OrdersController@index')->name('orders');
    Route::post('shippingStatus', 'OrdersController@shippingStatus')->name('shippingStatus');
    Route::post('status/change', 'OrdersController@changeStatus')->name('changeStatus');
    Route::get('detail/{uid}', 'OrdersController@show')->name('showOrder');
    Route::get('pdf/{UUID}', 'OrdersController@downloadPdf')->name('downloadPdf');
    Route::get('generate/pdf/{UUID}', 'OrdersController@generatePdfSlip')->name('generatePdfSlip');
});

Route::group(['prefix' => 'users', 'middleware' => ['admin']], function() {

    Route::get('feedback', 'FeedbackController@index')->name('feedBack');
});
