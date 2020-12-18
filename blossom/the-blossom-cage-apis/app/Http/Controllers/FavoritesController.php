<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller {

    function __construct() {

        $this->middleware(['user_auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->getFavoriteService()->index();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        try {
            return $this->getFavoriteService()->store();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            return $this->getFavoriteService()->destroy($id);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
