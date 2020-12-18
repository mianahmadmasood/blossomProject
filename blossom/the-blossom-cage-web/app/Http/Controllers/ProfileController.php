<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller {

    /**
     * Render view for change password
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword() {
        try {
            return $this->profile()->changePassword();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * update the password in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword() {
        try {
            return $this->profile()->updatePassword();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->profile()->index();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Show address form to edit
     *
     * @return \Illuminate\Http\Response
     */
    public function address() {
        try {
            return $this->profile()->address();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * sends email to selected email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword() {
        try {
            return $this->profile()->forgotPassword();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * sends email to selected email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword() {
        try {
            return $this->profile()->resetPassword();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * sends email to selected email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatResetPassword() {
        try {
            return $this->profile()->updatResetPassword();
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
    public function profileImageUpload(Request $request) {
        try {
            return $this->profileImage()->uploadProfileImage($request);
        } catch (\Exception $ex) {
            echo "<pre>";
            print_r($ex->getMessage());
            exit;
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
    public function update() {
        try {
            return $this->profile()->update();
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
