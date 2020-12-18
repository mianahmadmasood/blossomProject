<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;

class LoginController extends Controller {

    public function login(Login $request) {
        try {
            return $this->authenticateUser($request->email, $request->password, 1)->login();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function signout() {
        try {

            \Illuminate\Support\Facades\Auth::logout();
            \Illuminate\Support\Facades\Session::flush();
            return redirect()->route('login')->with('success_message', 'You have logged out successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

}
