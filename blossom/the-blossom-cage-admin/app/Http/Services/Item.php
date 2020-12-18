<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Product
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class Item extends Config
{

    protected $store_item_rules = [
        'default' => 'required',
        'model' => 'required',
        'en_title' => 'required',
        'ar_title' => 'required',
        'en_description' => 'required',
        'ar_description' => 'required',
        'en_short_description' => 'required',
        'ar_short_description' => 'required',
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'slug' => 'required|unique:items',
        'quantity' => 'required|numeric',
        'cart_quantity' => 'required|numeric|lte:quantity',
        'price' => 'required|numeric|min:1',
    ];

    /**
     * index method list the items presents
     * in the database
     * @return View
     */
    public function index()
    {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';
      
        $items = $this->getItemModel()->getIApprovedtems($searchText);
        $item_list_name='Live Products';
//        dd($items);
        return View('pages.items.all', compact('items', 'searchText','item_list_name'));
    }

    /**
     * pending method
     * get pending items from the database
     * @return View
     */
    public function pending()
    {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText =  !empty($request_params['search']) ? base64_decode($request_params['search']) : '';
        $items = $this->getItemModel()->getIPendingtems($searchText);
        $item_list_name='Product Draft Listing';
        return View('pages.items.all', compact('items', 'searchText','item_list_name'));
    }
    /**
     * pending method
     * get pending items from the database
     * @return View
     */
    public function outofstock()
    {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText =  !empty($request_params['search']) ? base64_decode($request_params['search']) : '';
        $items = $this->getItemModel()->getOutofstock($searchText);

        $data =[];
        $count =0;
        foreach ($items as $key => $item) {
            $item_quantity = $this->prepareItemQuantity($item);
            if($item_quantity == 0) {
                $data[$count] = $item;
                $count++;
            }

        }

        $items = $this->paginate($data);
        $item_list_name='Out of stock Products Listing';
        return View('pages.items.all', compact('items', 'searchText','item_list_name'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * archive method
     * get archive items from the database
     * @return View
     */
    public function deleted()
    {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $items = $this->getItemModel()->getIDeletedtems($searchText);
        return View('pages.items.deleted', compact('items', 'searchText'));
    }

    /**
     * show method
     * show item against a uuid
     * @param type $uuid
     * @return type
     */
    public function show($uuid)
    {

        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $uuid);
        $accessories = $this->getAccessorieModel()->where('archive', 0)->get();
        $cart_quantity = $this->prepareItemQuantity($item);
        $item->quantity = $cart_quantity;
        $item->cart_quantity = $cart_quantity <= 0 ? 0 : $cart_quantity <= $item->cart_quantity ? $cart_quantity : $item->cart_quantity;

        $techspecs = $this->getItemSpecificationModel()->where('item_id', $item->id)->get();
        
        $counter = 0;
        $techspec = [];
        if ($techspecs) {
            foreach ($techspecs as $row) {
                if ($row->type == 'en') {
                    $techspec[$counter]['title_en'] = $row->title;
                    $techspec[$counter]['value_en'] = $row->value;
                    $techspec[$counter]['desp_unit'] = $row->desp_unit;
                    $techspec[$counter]['unit'] = $row->unit;
                    $techspec[$counter]['id_en'] = $row->id;
                } elseif ($row->type == 'ar') {
                    $techspec[$counter]['title_ar'] = $row->title;
                    $techspec[$counter]['value_ar'] = $row->value;
                    // $techspec[$counter]['desp_unit'] = $row->desp_unit;
                    // $techspec[$counter]['unit'] = $row->unit;
                    $techspec[$counter]['id_ar'] = $row->id;
                    $counter++;
                }
            }
        }

        return View('pages.items.details', compact('item', 'techspec','accessories'));
    }


    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemQuantity($item)
    {
//        dd($item->colors);
        $total_sold_item = $this->getOrderItemModel()->fetchSoldItems($item->id);
//        dd($item->quantity);
//        $total_sold_item = $this->getOrderItemModel()->fetchSoldItemsColorQty($item->id);
        $remaining_stock = $item->quantity - $total_sold_item[0]->total_sum;
        if ($remaining_stock <= 0) {
            return 0;
        } elseif ($remaining_stock > 0) {
            return $remaining_stock;
        } else {
            return $item->quantity;
        }
    }


    /**
     * create method
     * return view to create an item
     * @return view
     */
    public function create()
    {

        $categories = $this->getCategoryModel()->getParentCategoriesForItemsCreate();
        $categories_sub = $this->getCategoryModel()->getSubCategoriesForItemsCreate();
        $brands = $this->getBrandModel()->getBrandssForItemsCreate();
        if (!empty($categories)) {
            return view('pages.items.add', compact('categories', 'categories_sub', 'brands'));
        }
        return redirect()->back()->with('error_message', 'No categories found for product creation.');
    }

    /**
     * store method
     * stores data related to the item, in the database
     * @param type $request
     * @return type
     */
    public function store($request)
    {

        $request_params = $request->except('_token');

        $request_params['user_id'] = !empty(Auth::user()) ? Auth::user()->id : 1;
        $request_params['en_title'] = preg_replace('/\s\s+/', ' ', $request_params['en_title']);
        $request_params['ar_title'] = preg_replace('/\s\s+/', ' ', $request_params['ar_title']);
        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

//        dd($request_params);
        $validate = $this->paramValidation($request_params);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        if (!empty($request_params['sale_price'])) {
            if ($request_params['price'] <= $request_params['sale_price']) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'Sale price should be less than orignal price.');
            }
        }

        $request_params = $this->calculateSalePrice($request_params);

        DB::beginTransaction();
        $save_item = $this->getItemModel()->create($request_params);

        if ($save_item) {
            $this->getItemQuantityLogService()->logQuantity($save_item);
            return $this->storeAndContinue($request_params, $save_item);
        }
    }

    public function paramValidation($request_params)
    {

        $validatResult = Validator::make($request_params, [

            'item_code' => ['required', Rule::unique('items')->where(function ($query) {
                return $query->where('archive', '!=', '1');
            })],
            'default' => 'required',
            'model' => 'required',
            'en_title' => 'required',
            'ar_title' => 'required',
            'en_description' => 'required',
            'ar_description' => 'required',
            'en_short_description' => 'required',
            'ar_short_description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'slug' => ['required', Rule::unique('items')->where(function ($query) {
                return $query->where('archive', '!=', '1');
            })],
//            'quantity' => 'required|numeric',
//            'cart_quantity' => 'required|numeric|lte:quantity',
            'price' => 'required|numeric|min:1',
            'cart_quantity' => 'required|numeric',

        ]);
        return $validatResult;
    }

//    public function calculateSalePrice($request_params)
//    {
//
//        $discount_type=$request_params['discounted_type'];
//
//        if($discount_type != 'fixed'){
//            $request_params['discount']=$request_params['sale_price'];
//            $dec = ($request_params['price'] - $request_params['sale_price']);
//            $result=(($dec/$request_params['price'])*100);
//            $request_params['sale_price']=$result;
//
//        }else{
//
//            $dec = ($request_params['price'] - $request_params['sale_price']);
//            $request_params['discount']=$dec;
//        }
//
//        return $request_params;
//    }

    /**
     * storeAndContinue method
     * take store process for the further
     * @param type $request_params
     * @param type $item
     * @return type
     */
    public function storeAndContinue($request_params, $item)
    {

        $images = [];

        foreach ($request_params['images'] as $key => $image) {
            $images[$key]['uuid'] = \Uuid::generate()->string;
            $images[$key]['item_id'] = $item->id;
            $images[$key]['image'] = $image;
            if ($request_params['default'] == $image) {
                $images[$key]['is_default'] = 1;
            } else {
                $images[$key]['is_default'] = 0;
            }
        }
        $insert_image = $this->getItemImageModel()->insert($images);

        if ($insert_image) {
            return $this->submitAndContinue($item, $request_params);
        }
    }

    /**
     * submitAndContinue method
     * take user to the next view
     * after adding basic item data
     * @param type $item
     * @param type $request_params
     * @return type
     */
    public function submitAndContinue($item, $request_params)
    {
        if ((empty($item))) {
            \DB::rollBack();
            return redirect()->back()->withInput($request_params)->with('error_message', 'Please enter the Product data correctly.');
        } else {
            \DB::commit();
            return redirect()->route('createVairants', ['id' => $item->uuid])->with('success_message', 'Product data saved successfully.');
        }


    }

//    /**
//     *
//     * @param type $item
//     * @param type $request_params
//     * @return type
//     */
//    protected function createItemSpecification($item, $request_params) {
//        $specs['type'] = 'en';
//        $specs['item_id'] = $item->id;
//        $specs['specifications'] = $request_params['specs_en'];
//        $create_en_specs = $this->getItemSpecificationModel()->create($specs);
//        if ($create_en_specs) {
//            $specs['type'] = 'ar';
//            $specs['specifications'] = $request_params['specs_ar'];
//            $create_ar_specs = $this->getItemSpecificationModel()->create($specs);
//            if ($create_ar_specs) {
//                DB::commit();
//                return redirect()->route('createVairants', ['id' => $item->uuid])->with('success_message', 'Product data saved successfully.');
//            }
//        } else {
//            DB::rollBack();
//            return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
//        }
//    }

    /**
     * createMetaData method
     * create the meta data for an item
     * @param type $id
     * @param type $v_uuid
     * @return View
     */
    public function createMetaData($id, $v_uuid)
    {

        return View('pages.items.metaData', compact('id', 'v_uuid'));
    }

    /**
     * storeMetaData function
     * stores meta data for an item
     * @param type $request
     * @return type
     */
    public function storeMetaData($request)
    {

        $request_params = $request->except('_token');

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_id']);
        if (empty($item) || $item->is_approved == 1) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found')->withInput($request_params);
        }
        $request_params['item_id'] = $item->id;
        $request_params['manual'] = array_filter($request_params['manual']);
        $request_params['link'] = array_filter($request_params['link']);
        if (!empty($request_params['manual']) && empty($request_params['link'])) {
            return $this->validateManualsData($request_params);
        }
        if (!empty($request_params['link']) && empty($request_params['manual'])) {
            return $this->validateVideosData($request_params);
        }
        if (!empty($request_params['manual']) && !empty($request_params['link'])) {
            return $this->validateMetadata($request_params);
        }
        if (empty($request_params['link']) && empty($request_params['manual'])) {
            return $this->makeItemApproved($request_params);
        }
    }

    /**
     * validateManualsData
     * @param type $request_params
     * @return type
     */
    protected function validateManualsData($request_params)
    {
        $validate = Validator::make($request_params['manual'], $this->add_manual_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        return $this->proceedForMetaData($request_params);
    }

    /**
     *
     * @param type $request_params
     * @return type
     */
    protected function validateVideosData($request_params)
    {
        $validate = Validator::make($request_params['link'], $this->add_video_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        return $this->proceedForMetaData($request_params);
    }

    /**
     *
     * @param type $request_params
     * @return type
     */
    protected function validateMetadata($request_params)
    {

        $validate = Validator::make($request_params['manual'], $this->add_manual_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        $validate = Validator::make($request_params['link'], $this->add_video_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        return $this->proceedForMetaData($request_params);
    }

    /**
     * proceedForMetaData method
     * pre data for meta data of an item
     * @param type $request_params
     * @param type $manual
     * @param type $links
     * @return type
     */
    public function proceedForMetaData($request_params)
    {

        $prepare_save_manual_data = $store_video_links = true;
        DB::beginTransaction();
        if (!empty($request_params['manual'])) {
            $prepare_save_manual_data = $this->prepareManualData($request_params, $request_params['manual']);
        }
        if (!empty($request_params['link'])) {
            $store_video_links = $this->prepareVideoData($request_params, $request_params['link']);
        }
        if ($prepare_save_manual_data && $store_video_links) {
            DB::commit();
            return $this->makeItemApproved($request_params);
        }
        return redirect()->back()->with('error_message', 'Internal server error')->withInput($request_params);
    }

    /**
     * prepareManualData prepare and save for item
     * @param type $request_params
     * @param type $manual
     * @return boolean
     */
    public function prepareManualData($request_params, $manual)
    {

        $upload_manual_en = $this->uploadSignPDF($manual['en_file'], $this->s3_image_paths['manual_pdf'], 'manual_');
        $upload_manual_ar = $this->uploadSignPDF($manual['ar_file'], $this->s3_image_paths['manual_pdf'], 'manual_');
        $en_manul = $ar_manual = [];
        if ($upload_manual_ar['success'] != true || $upload_manual_en['success'] != true) {
            return redirect()->back()->with('error_message', 'Internal server error')->withInput($request_params);
        }
        $en_manul['file'] = $upload_manual_en['file_name'];
        $en_manul['item_id'] = $request_params['item_id'];
        $en_manul['title'] = $manual['en_title'];
        $en_manul['type'] = 'en';
        $store_en_manual_data = $this->getItemManualModel()->create($en_manul);
        $ar_manul['file'] = $upload_manual_en['file_name'];
        $ar_manul['item_id'] = $request_params['item_id'];
        $ar_manul['title'] = $manual['en_title'];
        $ar_manul['type'] = 'ar';
        $store_ar_manual_data = $this->getItemManualModel()->create($ar_manul);
        if ($store_ar_manual_data && $store_en_manual_data) {
            return true;
        }
        return false;
    }

    /**
     * prepareVideoData prepares videos data
     * @param type $request_params
     * @param type $links
     * @return boolean
     */
    public function prepareVideoData($request_params, $links)
    {

        if (!empty($links['en']) && !empty($links['ar'])) {
            $en_vidoe['item_id'] = $request_params['item_id'];
            $en_vidoe['title'] = !empty($links['en_title']) ? $links['en_title'] : NULL;
            $en_vidoe['video'] = $links['en'];
            $en_vidoe['type'] = 'en';
            $ar_vidoe['item_id'] = $request_params['item_id'];
            $ar_vidoe['title'] = !empty($links['ar_title']) ? $links['ar_title'] : NULL;
            $ar_vidoe['video'] = $links['ar'];
            $ar_vidoe['type'] = 'ar';
            $save_en = $this->getItemVideoModel()->create($en_vidoe);
            $save_ar = $this->getItemVideoModel()->create($ar_vidoe);
            if ($save_ar && $save_en) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     *
     * @param type $uid
     * @return type
     */
    public function makeItemLive($key, $uid)
    {

        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $uid);
        if (!$item) {
            return redirect()->back()->with('error_message', 'No record found');
        }
        $item_variant = $this->getItemVariantModel()->getByColVal('item_id', $item->id);
        if (empty($item_variant->size) && $key == 'approve') {
            return redirect()->back()->with('error_message', 'This product does not meet the minimum requirements to be live');
        }
        if ($key == 'approve') {
            return $this->makeItemApproved(['item_id' => $item->id]);
        }
        if ($key == 'dismiss') {
            return $this->dissmissItem($item->id);
        }
    }

    /**
     * makeItemApproved method
     * approves an item in the database
     * @param type $request_params
     * @return redirect
     */
    public function makeItemApproved($request_params)
    {
        $approve_item = $this->getItemModel()->updateItemByColVal('id', $request_params['item_id'], ['is_approved' => 1]);
        if ($approve_item) {
            return redirect()->route('allItem')->with('success_message', 'Your selected product is live now.');
        }
    }

    /**
     * dismiss Item
     * @param type $item_id
     * @return type
     */
    public function dissmissItem($item_id)
    {
        $resultfavItem = $this->getUserFavItemsModel()->where('item_id', $item_id)->pluck('id')->toArray();
        if ($resultfavItem) {
            $this->getUserFavItemsModel()->whereIn('id', $resultfavItem)->delete();
        }
        $approve_item = $this->getItemModel()->updateItemByColVal('id', $item_id, ['is_approved' => 0]);
        if ($approve_item) {
            return redirect()->route('allItem')->with('success_message', 'Your selected product is de-activated .');
        }
    }

    /**
     *
     * @return type
     */
    public function changeProductRemovedStatus($key, $uid)
    {

        if ($key == 'remove') {
            $flag = 1;
        } else {
            $flag = 0;
        }
        $variantsCheck = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $uid);
        $resultfavItem = $this->getUserFavItemsModel()->where('item_id', $variantsCheck->id)->pluck('id')->toArray();
        if ($resultfavItem) {
            $this->getUserFavItemsModel()->whereIn('id', $resultfavItem)->update(['archive' => $flag]);
        }
        $change_status = $this->getItemModel()->updateItemByColVal('uuid', $uid, ['archive' => $flag]);
        if ($flag == 1 && $change_status) {
            return redirect()->back()->with('success_message', 'Product is removed successfully');
        } else if ($flag == 0 && $change_status) {
            return redirect()->back()->with('success_message', 'Product is Reactive successfully');
        }
        return redirect()->back()->with('error_message', 'Something went wrong');
    }

    /**
     *
     * @param type $key
     * @param type $uid
     * @return type
     */
    public function changeProductFeatureStatus($key, $uid)
    {


        $item = $this->getItemModel()->getItemByColumnValue('uuid', $uid);
        if ($key == 'add') {
            $item->is_featured = 1;
        } elseif ($key == 'remove') {
            $item->is_featured = 0;
        } else {
            $item->is_featured = 0;
        }
        if ($item->save()) {
            if ($key == 'add') {
                return redirect()->back()->with('success_message', 'Product has been added to featured list successfully.');
            } elseif ($key == 'remove') {
                return redirect()->back()->with('success_message', 'Product has been removed from featured list successfully.');
            } else {
                return redirect()->back()->with('success_message', 'Product has been removed from featured list successfully.');
            }
        }
    }


    public function getItems($search_params)
    {
        return $this->where(function ($innerSql) use ($search_params) {
                $innerSql->whereHas('category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0)->where('id', $search_params);

                });
            })
            ->with('videos', 'image', 'manuals', 'sizes', 'colors')
            ->where('is_approved', 1)
            ->orderBy('id', 'DSCE')
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->get();

    }

    public function dataenterindatabase()
    {
        $item = $this->getItemModel()->with('variants')->where('is_approved', 1)->get();

        foreach ($item as $row) {
                $color['item_id'] = $row->id;
                $color['uuid'] = \Uuid::generate()->string;
                $color['item_variant_id'] = $row['variants'][0]->id;
                $colorData = $this->getColorModel()->where('id',1)->first();
                $color['en_color_name'] =  $colorData->en_title ;
                $color['ar_color_name'] =  $colorData->ar_title ;
                $color['color_code'] = $colorData->color_code ;
                $color['color_quantity'] = 100;
                $color['color_id'] = 1;
                $color_store = $this->getItemColorModel()->create($color);
        }

        dd('done');

    }

}
