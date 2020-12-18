<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemImagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImg(Request $request) {
        try {

            return $this->getItemImageService()->addImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uid) {
        try {
            return $this->getItemImageService()->create($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            return $this->getItemImageService()->store($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid) {
        try {
            return $this->getItemImageService()->edit($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        try {

            return $this->getItemImageService()->update($request);
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
    public function destroy($id) {
        //
    }

    /**
     * change status the specified resource from storage.
     *
     * @param  int  $id
     * @param  string  status
     * @return \Illuminate\Http\Response
     */
    public function status($uid, $status) {
        try {
            return $this->getItemImageService()->status($uid, $status);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

}
