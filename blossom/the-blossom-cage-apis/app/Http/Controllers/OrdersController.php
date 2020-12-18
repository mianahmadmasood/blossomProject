<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller {

    function __construct() {

        $this->middleware(['api_auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        try {
            return $this->getOrderListService()->index();
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
            return $this->getOrderService()->placeOrder();
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
    public function show($id) {
        try {
            return $this->getOrderListService()->show($id);
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
    public function convertCurrency() {
        try {
            return $this->getOrderService()->convertCurrency();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update() {

        try {
            return $this->getPaytabsService()->updateTransactionData();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
