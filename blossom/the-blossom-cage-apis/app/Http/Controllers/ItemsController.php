<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller {

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
            return $this->getItemService()->getItems();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Show the the featured items
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeaturedItems() {
        try {
            return $this->getItemService()->featuredItems();
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
    public function checkQuantity(Request $request) {
        try {
            return $this->getQuantityControllService()->checkQuantity($request);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        try {

            return $this->getItemService()->showItem($slug);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
