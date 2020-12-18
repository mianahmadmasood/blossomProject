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

class Feedback extends Config {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $feedback = $this->getFeedbackModel()->getFeedback($searchText);
        return View('pages.feedback.feedback', compact('feedback', 'searchText'));
    }

}
