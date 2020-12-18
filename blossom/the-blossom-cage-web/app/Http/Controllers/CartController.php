<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {

    /**
     * View total item present in the shopping bag
     */
    public function index() {
        try {
            return $this->getCart()->viewShoppingBag();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Add single item to shopping bag
     */
    public function store() {
        try {
            return $this->getCart()->storeItem();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * update single item to shopping bag
     */
    public function storeupdateitem(Request $request) {
        try {

            return $this->getCart()->storeItemupdate();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * remove selected item from shopping bag
     */
    public function delete() {
        try {
            return $this->getCart()->removeItemFromShoppingbag();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    /**
     * remove selected item Accessories from shopping bag
     */
    public function deleteAccessories() {
        try {
            return $this->getCart()->removeItemAccessoriesFromShoppingbag();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * remove selected item from shopping bag
     */
    public function update() {
        try {
            return $this->getCart()->updateShoppingbag();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    /**
     * remove selected item from shopping bag
     */
    public function getCartData() {
        try {
            return $this->getCart()->getCartData();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    /**
     * remove selected item from shopping bag
     */
    public function getItemEditColor() {
        try {
            return $this->getCart()->getItemEditColors();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
