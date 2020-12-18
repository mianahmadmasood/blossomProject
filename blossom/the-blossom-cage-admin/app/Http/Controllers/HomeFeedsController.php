<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerStore;
use App\Http\Requests\TrendyItemStore;
use App\Http\Requests\topSaleItemStore;
use App\Http\Requests\FalshDealsStore;
use App\Http\Requests\TopCategoriesStore;
use App\Http\Requests\TopbrandsStore;
use App\Http\Requests\BannerUpdate;
use Illuminate\Http\Request;

class HomeFeedsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->getHomeFeedsService()->getBannersList();
    }

    public function indexTrendyItems()
    {

        return $this->getHomeFeedsService()->getTrendyItemsList();
    }

    public function indexTopSaleItem()
    {

        return $this->getHomeFeedsService()->getTopSaleList();
    }

    public function indexfalshDeals()
    {

        return $this->getHomeFeedsService()->getfalshDeals();
    }

    public function indextopCategories()
    {

        return $this->getHomeFeedsService()->gettopCategories();
    }

    public function indextopBrands()
    {

        return $this->getHomeFeedsService()->gettopBrands();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storeBanner($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storetopbrands(TopbrandsStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storeBanner($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storetopSaleProduct(topSaleItemStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storeBanner($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function storeTrendyItem(TrendyItemStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storeTrendyItems($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function storefalshDeals(FalshDealsStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storeBanner($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function storetopCategories(TopCategoriesStore $request)
    {

        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->storTopCategories($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        try {
            return $this->getHomeFeedsService()->getDeletedBanners();
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {

        return $this->getHomeFeedsService()->editBanner($uid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdate $request)
    {
        try {
            if ($request->validated()) {
                return $this->getHomeFeedsService()->updateBanner($request);
            }
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid, $status, $type)
    {
        try {
            return $this->getHomeFeedsService()->archive($uid, $status, $type);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    

    public function updateArchiveTrendyItem($uid, $status, $type)
    {
        try {
            return $this->getHomeFeedsService()->archive($uid, $status, $type);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function statusdestroy($uid, $status, $type)
    {
        try {
            return $this->getHomeFeedsService()->state($uid, $status, $type);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImg(Request $request)
    {
        try {
            return $this->getHomeFeedsService()->addImage($request);
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function OrderChange(Request $request)
    {
        try {

            return $this->getHomeFeedsService()->OrderChanging($request);
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

    public function ajaxCallForitem(Request $request)
    {
        try {
            return $this->getHomeFeedsService()->ajaxCallForitems($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function ajaxCallFortopSaleitem($id)
    {
        try {

            return $this->getHomeFeedsService()->ajaxCallFortopSaleitem($id);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }
    public function ajaxCalltopCategoryItems(Request $request)
    {
        try {
            return $this->getHomeFeedsService()->ajaxCalltopCategoryItem($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


}
