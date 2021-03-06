<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller {

    function __construct() {

        $this->middleware('api_auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        try {
          
            return $this->getCategoriesService()->listCategories();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
