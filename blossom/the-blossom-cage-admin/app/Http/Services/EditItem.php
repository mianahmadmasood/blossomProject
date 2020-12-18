<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of editItem
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Validator;

class EditItem extends Config
{

    /**
     * edit method
     * prepares resource for update
     * @param type $uid
     * @return view
     */
    public function edit($uid)
    {

        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $uid);

        $cart_quantity = $this->prepareItemQuantityForEditPage($item);
        $item->quantity = $cart_quantity;
        $item->cart_quantity = $cart_quantity <= 0 ? 0 : $cart_quantity <= $item->cart_quantity ? $cart_quantity : $item->cart_quantity ;

        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found');
        }
        $categories = $this->getCategoryModel()->getParentCategoriesDD();

        if(!empty($item->category_id)){
            $categoriesSub = $this->getCategoryModel()->getSubCategoriesForItemsEdit($item->category_id);
        }
        $brands = $this->getBrandModel()->getBrandssForItemsCreate();
        return view('pages.items.edit', compact('categories','categoriesSub','brands', 'item'));
    }

    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemQuantityForEditPage($item)
    {
        $total_sold_item = $this->getOrderItemModel()->fetchSoldItems( $item->id);
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
     * update method
     * updates item resource item in the database
     * @param type $request
     * @return redirect
     */
    public function update($request)
    {

        $request_parms = $request->except('_token');

        $item = $this->getItemModel()->getItemDetailsByColumnValue('id', $request_parms['id']);
        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found');
        }
        if (!empty($request_parms['sale_price'])) {
            if ($request_parms['price'] <= $request_parms['sale_price']) {
                return redirect()->back()->withInput($request_parms)->with('error_message', 'Sale price should be less than orignal price.');
            }
        }
        $update_ables = $this->prepareColumnsForItems($request_parms, $item);


        $update_ables = $this->calculateSalePrice($update_ables);


        $update_item = $this->getItemModel()->where('id', $request_parms['id'])->update($update_ables);
        if ($update_item) {
            return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Item data updated successfully');
        }
        return redirect()->route('dashboard')->with('error_message', 'Internal server error occured.');
    }

    /**
     * prepareColumnsForItems method
     * prepares the table values for update item table
     * @param type $request_parms
     * @return array
     */
    public function prepareColumnsForItems($request_parms, $item)
    {

        $arr = [];
        $arr['item_code'] = $request_parms['item_code'];
        $arr['model'] = $request_parms['model'];
        $arr['en_title'] = $request_parms['en_title'];
        $arr['ar_title'] = $request_parms['ar_title'];
        $arr['en_description'] = $request_parms['en_description'];
        $arr['ar_description'] = $request_parms['ar_description'];
        $arr['category_id'] = $request_parms['category_id'];
        $arr['sub_category_id'] = $request_parms['sub_category_id'];
        $arr['brand_id'] = $request_parms['brand_id'];
        $arr['price'] = $request_parms['price'];
        $arr['sale_price'] = $request_parms['sale_price'];
        $arr['en_short_description'] = $request_parms['en_short_description'];
        $arr['ar_short_description'] = $request_parms['ar_short_description'];
        $arr['discounted_type'] = $request_parms['discounted_type'];
//        $arr = $this->prepareItemQuantity($request_parms, $item, $arr);
       $arr['cart_quantity'] = $request_parms['cart_quantity'];;
        return $arr;
    }

    /**
     * prepareItemQuantity method
     * @param type $request_parms
     * @param type $item
     * @param type $arr
     */
    protected function prepareItemQuantity($request_parms, $item, $arr)
    {

        $item_stock = $this->getItemModel()->getFreshItemsCount('uuid', $item->uuid);

        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $item->uuid);
        $total_sold_item = $this->getOrderItemModel()->fetchSoldItems($item->id);
        $total_sold_item = $total_sold_item[0]->total_sum;
        $arr['quantity'] = $request_parms['quantity'] + $total_sold_item;

        if (($arr['quantity'] - $total_sold_item) < $item->cart_quantity) {
            $arr['cart_quantity'] = $arr['quantity'] - $total_sold_item;
        } elseif ($arr['quantity'] == 0) {
            $arr['cart_quantity'] = 0;
            $arr['is_sold'] = 1;
        } else {
            $arr['cart_quantity'] = $request_parms['cart_quantity'];
        }
        $this->getItemQuantityLogService()->logUpdateQuantity($item, $arr);
        return $arr;
    }

    /**
     *
     * @param type $uid
     * @return type
     */
    public function editSpecs($uid)
    {

        $specs = $this->getItemSpecificationModel()->getSpecsByColVal('uuid', $uid);
        if (empty($specs)) {
            return redirect()->back()->with('error_message', 'No record found!');
        }
        return view('pages.items.editSpecs', compact('specs'));
    }

    /**
     *
     * @param type $uid
     * @return type
     */
    public function createSpecs($uid)
    {


        $item = $this->getItemModel()->getItemByColumnValue('uuid', $uid);
        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found.');
        }
        return View('pages.items.CreateSpecs', compact('item'));
    }

    /**
     *
     * @param type $item
     * @param type $request_params
     * @return type
     */
    public function storespecs($request)
    {


        $request_params = $request->except('_token');
        if (empty($request_params['specs_en'])) {
            return redirect()->back()->withInput($request_params)->with('error_message', 'Please enter the Product speifications data correctly.');
        }
        if (empty($request_params['specs_ar'])) {
            return redirect()->back()->withInput($request_params)->with('error_message', 'Please enter the Product speifications data correctly.');
        }

        $specs['type'] = 'en';
        $specs['item_id'] = $request_params['item_id'];
        $specs['specifications'] = $request_params['specs_en'];
        $create_en_specs = $this->getItemSpecificationModel()->create($specs);

        if ($create_en_specs) {
            $specs['type'] = 'ar';
            $specs['specifications'] = $request_params['specs_ar'];
            $create_ar_specs = $this->getItemSpecificationModel()->create($specs);

            if ($create_ar_specs) {
                return redirect()->route('showItem', ['uid' => $request_params['uuid']])->with('success_message', 'Product technical specifications has been Saved.');
            }
        } else {
            return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
        }
    }

    /**
     *
     * @param type $uid
     * @return type
     */
    public function updateSpecs($request)
    {

        $request_params = $request->except('_token');

        $validate = Validator::make($request_params, $this->sepc_update_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }

        $specs = $this->getItemSpecificationModel()->getSpecsByColVal('uuid', $request_params['uuid']);
        if (empty($specs)) {
            return redirect()->back()->with('error_message', 'No record found!');
        }

        $specs->specifications = $request_params['specifications'];
        if ($specs->save()) {
            return redirect()->route('showItem', ['uid' => $specs->item->uuid])->with('success_message', 'Product technical specifications has been updated');
        }
        return redirect()->back()->with('error_message', 'Somthing went wrong!');
    }

}
