<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessoriesStore;
use App\Http\Requests\AccessoriesUpdate;
use Illuminate\Http\Request;

class AccessoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return $this->getAccessoriesService()->getAccessoriesList();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('pages.accessories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccessoriesStore $request) {

        try {
            if ($request->validated()) {
                return $this->getAccessoriesService()->storeAccessorie($request);
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
            return $this->getAccessoriesService()->getDeletedAccessories();
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

        return $this->getAccessoriesService()->editAccessorie($uid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccessoriesUpdate $request) {
        try {
            if ($request->validated()) {
                return $this->getAccessoriesService()->updateAccessorie($request);
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
            return $this->getAccessoriesService()->archive($uid, $status);
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
    public function statusdestroy($uid, $status) {
        try {
            return $this->getAccessoriesService()->state($uid, $status);
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
            return $this->getAccessoriesService()->addImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }




}
