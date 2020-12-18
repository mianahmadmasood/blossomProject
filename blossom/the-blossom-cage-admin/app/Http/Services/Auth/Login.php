<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author qadeer
 */

namespace App\Http\Services\Auth;

use App\Http\Services\Config;
use Illuminate\Support\Facades\Auth;

class Login extends Config {

    private $email;
    private $password;
    private $role;

    function __construct($email, $password, $role) {

        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role;
    }

    public function login() {
   
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
        ];

        if (Auth::attempt($credentials)) {
            if (!empty(session()->get('redirect_url'))) {
                $redirect_url = session()->get('redirect_url');
                session()->forget('redirect_url');
                return redirect()->to($redirect_url)->with('success_message', 'You have logged in successfully.');
            }
            return redirect()->route('dashboard')->with('success_message', 'You have logged in successfully.');
        } else {

            return redirect()->back()->with('error_message', 'Please provide valid credentials.');
        }
    }

}
