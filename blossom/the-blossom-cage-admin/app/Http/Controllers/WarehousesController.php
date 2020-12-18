<?php

namespace App\Http\Controllers;

use App\Http\Requests\warehouseStore;
use App\Http\Requests\WarehouseUpdate;
use Illuminate\Http\Request;

class WarehousesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return $this->getWarehousesService()->getWarehousesList();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.warehouse.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(warehouseStore $request) {

        try {

            if ($request->validated()) {
                return $this->getWarehousesService()->storeWarehouse($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return \App\Helpers\CommonHelper::adminException($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleted() {
        try {
            return $this->getWarehousesService()->getDeletedWarehouses();
        } catch (\Illuminate\Database\QueryException $ex) {
            return \App\Helpers\CommonHelper::adminException($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid) {

        return $this->getWarehousesService()->editWarehouse($uid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseUpdate $request) {
        try {
            if ($request->validated()) {
                return $this->getWarehousesService()->updateWarehouse($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid, $status) {
        try {
            return $this->getWarehousesService()->state($uid, $status);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImg(Request $request) {
        try {
            return $this->getWarehousesService()->addImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }




}
