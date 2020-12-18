<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerStore;
use App\Http\Requests\topSaleItemStore;
use App\Http\Requests\FalshDealsStore;
use App\Http\Requests\TopCategoriesStore;
use App\Http\Requests\TopbrandsStore;
use App\Http\Requests\BannerUpdate;
use Illuminate\Http\Request;

class HomeFeedsController extends Controller {

    function __construct() {

        $this->middleware('api_auth');
    }

    public function index() {

        try {
            return $this->getHomeFeedsService()->gethomefeeds();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }

    }

}
