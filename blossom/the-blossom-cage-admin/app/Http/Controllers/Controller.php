<?php

namespace App\Http\Controllers;

use App\Http\Services\Accessories;
use App\Http\Services\HomeFeeds;
use App\Http\Services\Brands;
use App\Http\Services\Colors;
use App\Http\Services\ItemAccessorie;
use App\Http\Services\ItemAccessories;
use App\Http\Services\ItemTechSpec;
use App\Http\Services\ItemWatt;
use App\Http\Services\Warehouses;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Services\Auth\Login;
use App\Http\Services\Categories;
use App\Http\Services\Item;
use App\Http\Services\Home;
use App\Http\Services\ItemImage;
use App\Http\Services\EditItem;
use App\Http\Services\MetaData;
use App\Http\Services\ItemVariant;
use App\Http\Services\Order;
use App\Http\Services\Employee;
use App\Http\Services\Customer;
use App\Http\Services\Profile;
use App\Http\Services\Feedback;
use App\Http\Services\ThumbnailService;
use App\Http\Services\ItemListing;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;


    use \App\Http\Traits\CommonService;

    public function authenticateUser($email, $password, $role) {

        return new Login($email, $password, $role);
    }

    public function getCategoriesService() {
        return new Categories();
    }

    public function getItemService() {
        return new Item();
    }

    public function getHomeService() {
        return new Home();
    }

    public function getItemImageService() {
        return new ItemImage();
    }

    public function getEditItemService() {
        return new EditItem();
    }

    public function getMetaDataService() {
        return new MetaData();
    }

    public function getOrderService() {
        return new Order();
    }

    public function getItemVariantService() {
        return new ItemVariant();
    }
    public function getItemTechSpecService() {

        return new ItemTechSpec();
    }
    public function getItemWattService() {
        return new ItemWatt();
    }

    public function getEmployeeService() {
        return new Employee();
    }
    public function getCustomerService() {
        return new Customer();
    }

    public function getProfileService() {
        return new Profile();
    }
    public function getThumnailsSevice() {
        return new ThumbnailService();
    }
    public function getFeedbackSevice() {
        return new Feedback();
    }
    public function getItemsListingService() {
        return new ItemListing();
    }
    public function getBrandsService()
    {
        return new Brands();
    }
    public function getHomeFeedsService()
    {
        return new HomeFeeds();
    }
    public function getAccessoriesService()
    {
        return new Accessories();
    }
    public function getItemAccessoriesService()
    {
        return new ItemAccessories();
    }
    public function getColorsService() {
        return new Colors();
    }
    public function getWarehousesService()
    {
        return new Warehouses();
    }

}
