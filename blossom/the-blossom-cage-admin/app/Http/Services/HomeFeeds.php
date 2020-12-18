<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Categories
 *    use \App\Http\Traits\UploadsService;
 * @author qadeer
 */

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Config;
use Psr\Log\NullLogger;

class HomeFeeds extends Config
{

    /**
     * getCategoriesList method
     * get all the categories
     * @return view
     */
    public function getBannersList()
    {
        $searchText = 'banners';
        $banners = $this->getHomeFeedModel()->getHomefeeds($searchText);
        $brands = $this->getBrandModel()->where('archive', 0)->get();
        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $items = $this->getItemModel()->getItemsForCreate();
        return view('pages.banners.all', compact('banners', 'brands', 'categories', 'items'));
    }

    public function gettopBrands()
    {
        $searchText = 'top_brands';
        $banners = $this->getHomeFeedModel()->getHomefeeds($searchText);
        $brands = $this->getBrandModel()->where('archive', 0)->get();
        return view('pages.topbrands.all', compact('banners', 'brands'));
    }

    public function getTrendyItemsList()
    {
        $searchText = 'trendy_item';
        $banners = $this->getHomeFeedModel()->getHomefeeds($searchText);
        $brands = $this->getBrandModel()->where('archive', 0)->get();
        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $items = $this->getItemModel()->getItemsForCreate();
        return view('pages.Trendyitem.all', compact('banners', 'brands', 'categories', 'items'));
   
    }

    

    public function getTopSaleList()
    {
        $searchText = 'top_sales';
        $banners = $this->getHomeFeedModel()->getnewHomefeeds($searchText);
        $brands = $this->getBrandModel()->where('archive', 0)->get();
        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $items = $this->getItemModel()->getItemsForCreate();
        return view('pages.topSaleItem.all', compact('banners', 'brands', 'categories', 'items'));
    }

    public function getfalshDeals()
    {
        $searchText = 'falshDeals';
        $banners = $this->getHomeFeedModel()->getnewHomefeeds($searchText);
        $brands = $this->getBrandModel()->where('archive', 0)->get();
        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $items = $this->getItemModel()->getItemsForCreate();
        return view('pages.falshDeals.all', compact('banners', 'brands', 'categories', 'items'));
    }

    public function gettopCategories()
    {
        $banners = $this->getHomeFeedModel()->getHomefeedsTopCategoires();

        $searchText = 'top_categories_1';
        $top_categories_1 = $this->getHomeFeedModel()->getnewHomefeeds($searchText);
        $searchText2 = 'top_categories_2';
        $top_categories_2 = $this->getHomeFeedModel()->getnewHomefeeds($searchText2);
        $searchText3 = 'top_categories_3';
        $top_categories_3 = $this->getHomeFeedModel()->getnewHomefeeds($searchText3);
        $searchText4 = 'top_categories_4';
        $top_categories_4 = $this->getHomeFeedModel()->getnewHomefeeds($searchText4);

        $brands = $this->getBrandModel()->where('archive', 0)->get();
        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $items = $this->getItemModel()->getItemsForCreate();
        return view('pages.topCategories.all', compact('banners', 'brands', 'categories', 'items', 'top_categories_1', 'top_categories_2', 'top_categories_3', 'top_categories_4'));
    }

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeBanner($request)
    {
        $request_params = $request->all();
        $request_param = $this->prepareParameters($request_params);
        return $this->storeBannerProcess($request_param);
    }

    public function storeTrendyItems($request)
    {
        $request_params = $request->all();
        $request_param = $this->prepareParameters($request_params);
        return $this->storeBannerProcess($request_param);
    }


    public function prepareParameters($reques_parameters)
    {
        $parameters = [];
        $parameters['uuid'] = \Uuid::generate()->string;
        $parameters['en_banner'] = !empty($reques_parameters['en_banner']) ? $reques_parameters['en_banner'] : "";
        $parameters['ar_banner'] = !empty($reques_parameters['ar_banner']) ? $reques_parameters['ar_banner'] : "";
        $parameters['type'] = !empty($reques_parameters['type']) ? $reques_parameters['type'] : 'banners';
        $parameters['brand_id'] = !empty($reques_parameters['brand_id']) ? $reques_parameters['brand_id'] : NULL;
        $parameters['item_id'] = NULL;
        $parameters['categories_id'] = NULL;
        $parameters['sub_categories_id'] = NULL;
        if (!empty($reques_parameters['category_id'])) {
            $cateIdsArray = explode('-', $reques_parameters['category_id']);
            $parameters['categories_id'] = $cateIdsArray['0'];
            $parameters['sub_categories_id'] = !empty($cateIdsArray['1']) ? $cateIdsArray['1'] : NULL;
        }
        if (!empty($reques_parameters['item_id'])) {
            $itemIdsArray = explode('-', $reques_parameters['item_id']);
            $parameters['item_id'] = $itemIdsArray['0'];
            $parameters['categories_id'] = $itemIdsArray['1'];
            $parameters['sub_categories_id'] = $itemIdsArray['2'];
        }
        return $parameters;
    }

    public function storeTopcategoiresProcess($request_params)
    {
        $result = $this->validationDataWithDataBaseForTopCategories($request_params);
        if (count($result) == 0) {
            $store = $this->getHomeFeedModel()->create($request_params);
            $store->ordering_sort = $store->id;
            $store->save();
            if ($store) {
                return $this->pageReturnSuccessMassage($request_params);
            } else {

                return redirect()->back()->with('error_message', 'Internal server error occured');
            }
        } else {
            return redirect()->back()->with('error_message', 'Your selected value is already exist, Please select the other value.');

        }
    }

    public function validationDataWithDataBaseForTopCategories($request_params)
    {

        $query = $this->getHomeFeedModel()->where('type', $request_params['type'])
            ->where('item_id', $request_params['item_id'])
            ->where('archive', 0)
            ->get();
        return $query;
    }

    public function storeBannerProcess($request_params)
    {
        $result = $this->validationDataWithDataBase($request_params);
        if (count($result) == 0) {
            $store = $this->getHomeFeedModel()->create($request_params);
            $store->ordering_sort = $store->id;
            $store->save();
            if ($store) {
                return $this->pageReturnSuccessMassage($request_params);
            } else {

                return redirect()->back()->withInput($request_params)->with('error_message', 'Internal server error occured');
            }
        } else {
            return redirect()->back()->withInput($request_params)->with('error_message', 'Your selected value is already exist, Please select the other  value.');
        }
    }

    public function validationDataWithDataBase($request_params)
    {
        $query = $this->getHomeFeedModel()->where('type', $request_params['type'])
            ->where('item_id', $request_params['item_id'])
            ->where('categories_id', $request_params['categories_id'])
            ->where('sub_categories_id', $request_params['sub_categories_id'])
            ->where('brand_id', $request_params['brand_id'])
            ->where('archive', 0)
            ->get();
        return $query;
    }

    public function pageReturnSuccessMassage($request_params)
    {
        if (!empty($request_params['type']) && $request_params['type'] == 'top_sales') {
            return redirect()->route('gettopSaleProduct')->with('success_message', 'Top Sale Product data is saved successfully');
        }
        else if (!empty($request_params['type']) && $request_params['type'] == 'trendy_item') {
            return redirect()->route('getTrendyItems')->with('success_message', 'Trendy item data is saved successfully');
        } else if (!empty($request_params['type']) && $request_params['type'] == 'falshDeals') {
            return redirect()->route('getfalshDeals')->with('success_message', 'FalshDeals data is saved successfully');
        } else if (!empty($request_params['type']) && $request_params['type'] == 'top_brands') {
            return redirect()->route('gettopBrands')->with('success_message', 'Top Brands data is saved successfully');
        } else if (!empty($request_params['type']) && $request_params['type'] == 'top_categories_1' || $request_params['type'] == 'top_categories_2' || $request_params['type'] == 'top_categories_3' || $request_params['type'] == 'top_categories_4') {
            return redirect()->route('gettopCategories')->with('success_message', 'Top Categories data is saved successfully');
        } else {
            return redirect()->route('getBanners')->with('success_message', 'Banner data is saved successfully');
        }
    }


    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request)
    {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['banner_images'], 'banner_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    public function OrderChanging($request)
    {

        $request_params = $request->except('_token');
        $type = !empty($request_params['type']) ? $request_params['type'] : "banners";
//        $banners = $this->getHomeFeedModel()->where('archive', '0')->where('type', $type)->get();
        $banners = $this->getHomeFeedModel()
            ->where('archive', '0')
            ->where('type', $type)
            ->whereIn('ordering_sort', $request['position'])
            ->get();

        foreach ($banners as $key => $banner) {

            $update = $this->getHomeFeedModel()->where('id', $banner->id)->update(['ordering_sort' => $request['position'][$key]]);
        }

        if ($update) {
            $response['data'] = $update;
            return $this->jsonSuccessResponse('Banner updated saved successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }

    }

    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedBanners()
    {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $banners = $this->getHomeFeedModel()->getBannersArhived($searchText);
        return view('pages.banners.deleted', compact('banners', 'searchText'));
    }

    /**
     * state method
     * change the status of the category
     * @param type $uid
     * @param type $state
     * @return redirect
     */
    public function archive($uid, $state, $type)
    {

        if ($state == 'in-active') {
            $archive = 1;
        } else {
            $archive = 0;
        }

        $update = $this->getHomeFeedModel()->where('uuid', $uid)->where('type', $type)->update(['archive' => $archive]);
        if ($update) {
            if (!empty($type) && $type == 'top_sales') {
                return redirect()->back()->with('success_message', 'Top Sale Product  updated saved successfully');
            }
            else if (!empty($type) && $type == 'trendy_item') {
                return redirect()->route('getTrendyItems')->with('success_message', 'Trendy item data is saved successfully');
            } else if (!empty($type) && $type == 'falshDeals') {
                return redirect()->back()->with('success_message', 'FalshDeals updated saved successfully');
            } else if (!empty($type) && $type == 'top_brands') {
                return redirect()->back()->with('success_message', 'Top Brands updated saved successfully');
            } else if (!empty($type) && $type == 'top_categories_1' || $type == 'top_categories_2' || $type == 'top_categories_3' || $type == 'top_categories_4') {
                return redirect()->back()->with('success_message', 'Top Categories updated saved successfully');
            } else {
                return redirect()->back()->with('success_message', 'Banner updated saved successfully');
            }

        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * state method
     * change the status of the category
     * @param type $uid
     * @param type $state
     * @return redirect
     */
    public function state($uid, $state, $type)
    {

        if ($state == 'in-active') {
            $archive = 1;
            $getItem = $this->getHomeFeedModel()->where('uuid', $uid)->where('type', $type)->first();

            if (!empty($getItem->item_id) && $getItem->item_id != null) {
                $checkItem = $this->getItemModel()->getItemDetailsByColumnValueForexist('id', $getItem->item_id);
                if (empty($checkItem) && $checkItem == null) {
                    return redirect()->back()->with('error_message', 'This product is deactivated, You can only display active products.');
                }
            }

        } else {
            $archive = 0;
        }
        $update = $this->getHomeFeedModel()->where('uuid', $uid)->where('type', $type)->update(['status' => $archive]);
//        dd($type);
        if ($update) {

            if (!empty($type) && $type == 'top_sales') {
                return redirect()->back()->with('success_message', 'Top Sale Product  updated saved successfully');
            }else if (!empty($type) && $type == 'trendy_item') {
                return redirect()->route('getTrendyItems')->with('success_message', 'Trendy item data is saved successfully');
            }
             else if (!empty($type) && $type == 'falshDeals') {
                return redirect()->back()->with('success_message', 'FalshDeals updated saved successfully');
            } else if (!empty($type) && $type == 'top_brands') {
                return redirect()->back()->with('success_message', 'Top Brands updated saved successfully');
            } else if (!empty($type) && $type == 'top_categories_1' || $type == 'top_categories_2' || $type == 'top_categories_3' || $type == 'top_categories_4') {
                return redirect()->back()->with('success_message', 'Top Categories updated saved successfully');
            } else {
                return redirect()->back()->with('success_message', 'Banner updated saved successfully');
            }

        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * ajaxCall method
     * fetch data on ajax call for sub-categories
     * @param type $id
     * @return type
     */
    public function ajaxCallForitems($request)
    {
        $request_params = $request->except('_token');
        $str = '<option value=""> Select a item.</option>';
        $items = $this->getItemModel()->getItemsForCreatehomesfeeds($request_params);
        foreach ($items as $item) {
            $str = $str . "<option value='$item->id-$item->category_id-$item->sub_category_id'>$item->en_title - $item->ar_title</option>";
        }
        return $this->jsonSuccessResponse('items found', $str);
    }

    /**
     * ajaxCall method
     * fetch data on ajax call for sub-categories
     * @param type $id
     * @return type
     */
    public function ajaxCalltopCategoryItem($request)
    {
        $request_params = $request->except('_token');
        $str = '<option value=""> Select a item.</option>';
        $items = $this->getItemModel()->getItemsForCreatehomesfeeds($request_params);
        foreach ($items as $item) {
            $str = $str . "<option value='$item->id'>$item->en_title - $item->ar_title</option>";
        }
        return $this->jsonSuccessResponse('items found', $str);
    }

    /**
     * ajaxCall method
     * fetch data on ajax call for sub-categories
     * @param type $id
     * @return type
     */
    public function ajaxCallFortopSaleitem($id)
    {

        $items = $this->getItemModel()->getItemByColumnValue('id', $id);
        if (!empty($items->images[0]->image)) {
            $image = config('paths.home_url').'thumbnails/large/items/' . $items->images[0]->image;
        } else {
            $image = config('paths.home_url').'thumbnails/large/categories/Category_5daf2155ba6481571758421.jpg';
        }
        $str = '<img style="float: left;margin: 0 10px 0 0;" height="80" width="80"
                                     src="' . $image . '">
                                <p class="col-form-label"> Sale Price :';
        $str .= $items->sale_price . ' Orignal Price :' . $items->price . '';
        $str .= '</p><label class="col-form-label" style="text-align: left;">';
        $str .= $items->en_title . '</label>';
        return $this->jsonSuccessResponse('items found', $str);
    }

    public function storTopCategories($request)
    {
        $request_params = $request->all();
        $request_param = $this->prepareParametersTopCategories($request_params);
        return $this->storeTopcategoiresProcess($request_param);
    }

    public function prepareParametersTopCategories($reques_parameters)
    {
        $parameters = [];
        $parameters['uuid'] = \Uuid::generate()->string;
        $parameters['type'] = !empty($reques_parameters['type']) ? $reques_parameters['type'] : 'banners';
        $parameters['en_banner'] = '';
        $parameters['ar_banner'] = '';
        $parameters['brand_id'] = NULL;
        $parameters['categories_id'] = !empty($reques_parameters['banner_categoires_for_item']) ? $reques_parameters['banner_categoires_for_item'] : 'banners';
        $parameters['sub_categories_id'] = !empty($reques_parameters['banner_subCategoires_for_item']) ? $reques_parameters['banner_subCategoires_for_item'] : 'banners';
        $parameters['item_id'] = !empty($reques_parameters['item_id']) ? $reques_parameters['item_id'] : 'banners';
        return $parameters;
    }


}
