<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotpaswordController extends Controller {

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
            return $this->getForgotPasswordService()->sendCode();
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
    public function resetPassword() {

        try {
            return $this->getForgotPasswordService()->resetPassword();
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
        //
    }

}
