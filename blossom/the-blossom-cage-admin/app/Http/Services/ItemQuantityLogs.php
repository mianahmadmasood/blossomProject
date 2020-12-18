<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemQuantityLogs
 *
 * @author qadeer
 */
use App\Http\Services\Config;

class ItemQuantityLogs extends Config {

    /**
     * log item quantity for the first time
     * @param type $item
     * @return type
     */
    public function logQuantity($item) {

        $data = [];
        $data['item_id'] = $item->id;
        $data['previous_stock_quantity'] = 0;
        $data['new_stock_quantity'] = 0;
        return $this->getItemQuantityLogModel()->create($data);
    }

    /**
     * logUpdateQuantity method
     * @param type $item
     * @param type $arr
     * @return type
     */
    public function logUpdateQuantity($item, $arr) {

        $data = [];
        $data['item_id'] = $item->id;
        $data['previous_stock_quantity'] = $item->quantity;
        $data['new_stock_quantity'] = $arr['quantity'];
        return $this->getItemQuantityLogModel()->create($data);
    }
    public function logUpdateQuantityItemColor($item, $arr) {

        $data = [];
        $data['item_id'] = $item->id;
        $data['previous_stock_quantity'] = $arr['color_qty'];
        $data['new_stock_quantity'] = $arr['color_qty'];
        return $this->getItemQuantityLogModel()->create($data);
    }

}
