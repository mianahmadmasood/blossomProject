<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseUserFavorites
 *
 * @author qadeer
 */
use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Collection;

class ResponseUserFavorites extends BaseResponse {

    protected $items;
    protected $lang;

    function __construct(Collection $items, string $lang) {

        $this->items = $items;
        $this->lang = $lang;
    }

    public function prepareUserFavoritesResponse() {

        $data = [];
        foreach ($this->items as $key => $f_item) {


            $data[$key]['uuid'] = $f_item->uuid;
            $data[$key]['item_id'] = $f_item->item->uuid;
            $data[$key]['title'] = $this->lang == 'ar' ? $f_item->item->ar_title : $f_item->item->en_title;
            $data[$key]['en_title'] = $f_item->item->en_title;
            $data[$key]['ar_title'] = $f_item->item->ar_title;
            $data[$key]['price'] = $f_item->item->price;
            $data[$key]['sale_price'] = $f_item->item->sale_price;

            $data[$key]['quantity'] = $this->prepareItemQuantity($f_item->item);
            $data[$key]['cart_quantity'] = $f_item->item->cart_quantity;

            $data[$key]['slug'] = $f_item->item->slug;
            $data[$key]['weight'] = $f_item->item->size->weight;
            $data[$key]['weight_unit'] = $f_item->item->size->weight_unit;
            $data[$key]['image'] = $f_item->item->image->image;
        }
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];
        return $this->jsonSuccessResponse($response_message, $data);
    }

    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemQuantity($item) {

//        $order_items = new \App\Item();
//        $item_stock = $order_items->getFreshItemsCount('uuid', $item->uuid);
//        if (!empty($item_stock)) {
//            $total_sold_item = $item_stock->ordersItems->sum('quantity');
//            $remaining_stock = $item->quantity - $total_sold_item;
//            if ($remaining_stock < 0) {
//                return 0;
//            }
//            return $remaining_stock;
//        } else {
//            return $item->quantity;
//        }


        $order_items = new \App\OrderItem();
        $total_sold_item = $order_items->fetchSoldItems( $item->id);
        if (!empty($total_sold_item)) {
            $remaining_stock = $item->quantity - $total_sold_item;
            if ($remaining_stock < 0) {
                return 0;
            }
            return $remaining_stock;
        } else {
            return $item->quantity;
        }

    }

}
