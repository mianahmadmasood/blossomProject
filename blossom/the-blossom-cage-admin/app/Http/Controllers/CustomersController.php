<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->getCustomerService()->index();
        } catch (Exception $ex) {
            
        }
    }

    public function indexForbug() {
        try {
            return $this->getCustomerService()->indexForbug();
        } catch (Exception $ex) {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$type) {
        try {
            return $this->getCustomerService()->show($id,$type);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

}
