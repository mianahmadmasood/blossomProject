<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->Order()->index();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Show the success page after placement
     *
     * @return \Illuminate\Http\Response
     */
    public function success() {
        try {
            return $this->orderPayment()->success();
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

            return $this->Order()->placeOrder();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckout() {
        try {

            return $this->checkout()->showCheckout();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id) {
        try {
            return $this->Order()->show($lang, $id);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrderDetail($uuid) {
        try {
            return $this->Order()->show($uuid);
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
    public function jsonFile() {

        $content = file_get_contents(public_path('filejson.json'));
        return $content;
    }

}
