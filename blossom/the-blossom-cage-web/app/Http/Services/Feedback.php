<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Feedback
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;

class Feedback extends Config {

    protected $headers;

    function __construct() {
        if (Auth::check()) {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ];
        } else {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale')
            ];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('pages.feedback');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {

        $request_params = Input::except('_token');
        $request_data = [
            'form_params' => $request_params,
            'headers' => $this->headers
        ];
        $response = $this->guzzleRequest('users/feedback/store', 'POST', $request_data);
        if ($response['success'] == false) {

            return redirect()->back()->withInput($request_params)->with('error_message', $response['message']);
        }
        return redirect()->back()->with('success_message', $response['message']);
    }

    /**
     * store feedback
     * @return type
     */
    public function contactStore() {

        $request_params = Input::except('_token');
        $request_params['type'] = 'ticket';
        $request_data = [
            'form_params' => $request_params,
            'headers' => $this->headers
        ];
        $response = $this->guzzleRequest('users/feedback/store', 'POST', $request_data);

        if ($response['success'] == true) {
            return $this->jsonSuccessResponseWithoutData($response['message']);
        }
        return $this->jsonErrorResponse($response['message']);
    }

}
