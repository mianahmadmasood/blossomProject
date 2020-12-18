<?php

namespace App\Http\Controllers;

class BrandsController extends Controller {

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



}
