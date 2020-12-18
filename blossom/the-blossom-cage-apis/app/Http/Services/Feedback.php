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
use Illuminate\Support\Facades\Validator;

class Feedback extends Config {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {

        $request_params = Input::all();

        $validation = Validator::make($request_params, $this->feedback, $this->selectRulesLang($rules = 'feedback', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }
        if (!empty($request_params['user'])) {
            $request_params['type'] = $request_params['type'];
            $request_params['user_id'] = $request_params['user']->id;
            $request_params['email'] = $request_params['user']->email;
            $request_params['name'] = $request_params['user']->first_name . ' ' . $request_params['user']->last_name;
        }

        $save_feedback = $this->getFeedbackModel()->create($request_params);
        if ($save_feedback) {
            if ($request_params['type'] == 'feedback') {
                return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['feedback_success']);
            } else {
                return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['ticket_success']);
            }
        }
        return $this->jsonSuccessResponse($this->getMessageData('error', $request_params['lang'])['general_errror']);
    }

}
