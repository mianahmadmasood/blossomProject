<?php

namespace App\Http\Controllers;

class ItemsController extends Controller {

    /**
     * Get all the items list according to filter
     * @return type
     */
    public function filterItems() {
        try {
            return $this->itemService()->filterItems();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Get all the Featured Item list
     * @return type
     */
    public function getFeaturedItem() {
        try {
            return $this->itemService()->getFeaturedItem();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * show single item details
     * @param type $slug
     * @return type
     */
    public function itemDetails($lang, $slug) {
        try {
            return $this->itemService()->show($lang, $slug);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * get Categories for products
     * @param type $slug
     * @return type
     */
    public function getCategories() {
        try {
            return $this->home()->getCategories();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
