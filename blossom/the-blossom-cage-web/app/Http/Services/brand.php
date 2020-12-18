<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemService
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;

class brand extends Config {

    protected $headers;

    function __construct() {
        if (Auth::check()) {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token,
                'currency' => Session::get('cur_currency'),
            ];
        } else {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'currency' => Session::get('cur_currency'),
            ];
        }
    }

}
