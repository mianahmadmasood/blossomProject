<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemQuantity
 *
 * @author qadeer
 */

use App\Http\Services\Config;

class ItemQuantity extends Config
{

    /**
     * check item quantity service
     * @param type $request
     * @return type
     */
    public function checkQuantity($request)
    {
        $request_params = $request->all();

        $quantity_response_outstock = $this->checkItemsQuantity($request_params['items'], $request_params['lang']);
//            dd($quantity_response_outstock);
        if ($quantity_response_outstock['success'] == true) {
            return $this->jsonSuccessResponse($this->getMessageData('error', $request_params['lang'])['products_outof_stock'], $quantity_response_outstock['items'], 601);
        } else {
            return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['general_success'], 602);
        }
    }

    /**
     * check item quantity
     * @param type $items
     * @return boolean
     */
    public function checkItemsQuantity($items, $lang = 'en')
    {

        $response = [];
        $items_outof_stock = [];
//        $items_uuids = $this->prepareItemsUUIDS($items);
        $items_uuids = $this->prepareItemsUUIDSANDCOLORSID($items);

//        dd($items_uuids['uuids']);
//        $items_instock = $this->getItemModel()->getFreshItems($items_uuids);
        $items_instock = $this->getItemModel()->getFreshItems($items_uuids['uuids']);
        foreach ($items as $p_item) {

            $fresh_item = $items_instock->where('uuid', $p_item['uuid'])->first();
//            dd($fresh_item);
            $fresh_item_color = $this->getItemColorModel()->where('item_id', $fresh_item->id)->where('id',$p_item['color_id'])->where('archive','0')->first();
//            dd($fresh_item_color);
                $flags = $this->outStockCheckitemColor($fresh_item_color, $p_item, $fresh_item);
//                dd($flags);
//            $flags = $this->outStockCheck($fresh_item, $p_item);
            if ($flags['outof_stock'] == true || $flags['not_availble'] == true || $flags['not_availble_color'] == true || $flags['not_availble_color_qty'] == true ) {
                $items_outof_stock[] = $this->preapreResponseItems($fresh_item, $lang, $flags,$fresh_item_color,$p_item['color_id']);

            }
        }

//        dd($items_outof_stock);
        if (!empty($items_outof_stock)) {
            $response['items'] = $items_outof_stock;
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        return $response;
    }

    /**
     * @param $fresh_item
     * @param $p_item
     * @return mixed
     */
    protected function outStockCheckitemColor($fresh_item_color, $p_item,$fresh_item)
    {

        $flags['outof_stock'] = false;
        $flags['not_availble'] = false;
        $flags['not_availble_color'] = false;
        $flags['not_availble_color_qty'] = false;

//        dd($fresh_item_color);
        if(!empty($fresh_item_color)) {
            $total_sold_quantity = $this->getOrderItemModel()->fetchSoldItemsColorQty($fresh_item_color->item_id, $p_item['color_id']);

//        dd($total_sold_quantity);

        $freshitemsColor = isset($fresh_item_color->color_quantity) ? $fresh_item_color->color_quantity : 0;

        $remaing_stock_check = $freshitemsColor - $total_sold_quantity;

        if ($fresh_item->archive == 1 || $fresh_item->is_approved == 0 ) {
            $flags['not_availble'] = true;
        } elseif ($fresh_item_color->archive == 1) {
            $flags['not_availble_color'] = true;
        } elseif ($fresh_item->category->archive == 1 || $fresh_item->sub_category->archive == 1 || $fresh_item->brand->archive == 1 || $fresh_item->brand->status == 1 ) {
            $flags['not_availble'] = true;
        } elseif (($remaing_stock_check < $p_item['quantity'])) {
            $flags['not_availble_color_qty'] = true;
//            $flags['outof_stock'] = true;
            if ($fresh_item->archive == 1 || $fresh_item->is_approved == 0 || $fresh_item->category->archive == 1 || $fresh_item->sub_category->archive == 1 || $fresh_item->brand->archive == 1 || $fresh_item->brand->status == 1) {
                $flags['not_availble'] = true;
            }
        } elseif ($remaing_stock_check <= 0) {
            $flags['outof_stock'] = true;
        }
        }else{
            $flags['not_availble_color'] = true;
        }
        return $flags;
    }

    protected function outStockCheck($fresh_item, $p_item)
    {



        $flags['outof_stock'] = false;
        $flags['not_availble'] = false;



        $total_sold_quantity = $this->getOrderItemModel()->fetchSoldItems($fresh_item->id);


        $freshitems = isset($fresh_item->quantity) ? $fresh_item->quantity : 0;

        $remaing_stock_check = $freshitems - $total_sold_quantity;


        if ($fresh_item->archive == 1 || $fresh_item->is_approved == 0) {
            $flags['not_availble'] = true;
        } elseif ($fresh_item->category->archive == 1 || $fresh_item->sub_category->archive == 1 || $fresh_item->brand->archive == 1 || $fresh_item->brand->status == 1 ) {
            $flags['not_availble'] = true;
        } elseif (($remaing_stock_check < $p_item['quantity'])) {
            $flags['outof_stock'] = true;
            if ($fresh_item->archive == 1 || $fresh_item->is_approved == 0 || $fresh_item->category->archive == 1 || $fresh_item->sub_category->archive == 1 || $fresh_item->brand->archive == 1 || $fresh_item->brand->status == 1) {
                $flags['not_availble'] = true;
            }
        } elseif ($remaing_stock_check <= 0) {
            $flags['outof_stock'] = true;
        }
        return $flags;
    }

    /**
     *
     * @param type $f_item
     * @return type
     */
    public function preapreResponseItems($f_item, $lang, $flags,$fresh_item_color ,$p_color_id)
    {

        $response_items['uuid'] = $f_item->uuid;

        if ($flags['outof_stock'] == true) {
            $response_items['is_sold'] = true;
        } else {
            $response_items['is_sold'] = false;
        }
        if ($flags['not_availble'] == true) {
            $response_items['availability'] = true;
        } else {
            $response_items['availability'] = false;
        }

        if ($flags['not_availble_color'] == true) {
            $response_items['availability'] = true;
        } else {
            $response_items['availability'] = false;
        }
        if ($flags['not_availble_color_qty'] == true) {
            $response_items['availability'] = true;
        } else {
            $response_items['availability'] = false;
        }



//        $total_sold_quantity = $this->getOrderItemModel()->fetchSoldItems($f_item->id);
        if(!empty($fresh_item_color)) {
            $total_sold_quantity = $this->getOrderItemModel()->fetchSoldItemsColorQty($f_item->id, $fresh_item_color->id);

//        $freshitems = isset($f_item->quantity) ? $f_item->quantity : 0;
//        $remaing_stock_check = $freshitems - $total_sold_quantity;


            $freshitemsColor = isset($fresh_item_color->color_quantity) ? $fresh_item_color->color_quantity : 0;

            $remaing_stock_check = $freshitemsColor - $total_sold_quantity;

            if ($remaing_stock_check < 0) {
                $response_items['quantity'] = 0;
                $response_items['cart_quantity'] = 0;
            } else {
//            if ($remaing_stock_check < $fresh_item_color->color_quantity) {
//                $response_items['cart_quantity'] = $remaing_stock_check;
//                $fresh_item_color->color_quantity = $remaing_stock_check;
//                $fresh_item_color->save();
//            } else {
//                $response_items['cart_quantity'] = $fresh_item_color->color_quantity;
//            }
                $response_items['quantity'] = $remaing_stock_check;
                $response_items['cart_quantity'] = $remaing_stock_check;

            }
//        if ($remaing_stock_check < 0) {
//            $response_items['quantity'] = 0;
//            $response_items['cart_quantity'] = 0;
//        } else {
//            if ($remaing_stock_check < $f_item->cart_quantity) {
//                $response_items['cart_quantity'] = $remaing_stock_check;
//                $f_item->cart_quantity = $remaing_stock_check;
//                $f_item->save();
//            } else {
//                $response_items['cart_quantity'] = $f_item->cart_quantity;
//            }
//            $response_items['quantity'] = $remaing_stock_check;
//        }}

            $response_items['color_id'] = $fresh_item_color->id;
        }else{
            $response_items['quantity'] = 0;
            $response_items['cart_quantity'] = 0;
            $response_items['color_id'] = $p_color_id;
        }

        $response_message = $this->prepareMessage($f_item, $lang, $flags);
        $response_items['message'] = $response_message['msg'];
        $response_items['status_code'] = $response_message['status_code'];
        return $response_items;
    }

    /**
     *
     * @param type $f_item
     * @param type $lang
     * @return type
     */
    public function prepareMessage($f_item, $lang, $flags)
    {
        $message = [];
        if ($flags['outof_stock'] == true && $flags['not_availble'] == false) {
//            $message = $this->getMessageData('error', $lang)['product_out_stock'];
            $message['msg'] = $this->getMessageData('error', $lang)['product_out_stock_color'];
            $message['status_code'] = 611;
        }
        if ($flags['not_availble'] == true) {
            $message['msg']  = $this->getMessageData('error', $lang)['product_deactivated'];
            $message['status_code'] = 612;
        }
        if ($flags['not_availble_color'] == true) {
            $message['msg']  = $this->getMessageData('error', $lang)['product_deactivated_color'];
            $message['status_code'] = 613;
        }
        if ($flags['not_availble_color_qty'] == true) {
            $message['msg']  = $this->getMessageData('error', $lang)['product_color_qty'];
            $message['status_code'] = 614;
        }

        return $message;
    }

    /**
     * prepare items uuid to query database
     * @param type $items
     * @return type
     */
    protected function prepareItemsUUIDS($items)
    {

        $uuids = [];
        foreach ($items as $item) {
            $uuids[] = $item['uuid'];
        }
        return $uuids;
    }
    /**
     * prepare items uuid to query database
     * @param type $items
     * @return type
     */
    protected function prepareItemsUUIDSANDCOLORSID($items)
    {

        $uuids = [];
        $colorids = [];
        foreach ($items as $item) {
            $uuids[] = $item['uuid'];
            $colorids[] = $item['color_id'];
        }
        $uuidandcolorid['uuids']=$uuids;
        $uuidandcolorid['colorids']=$colorids;
        return $uuidandcolorid;
    }

}
