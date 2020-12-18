<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller {

    use \App\Http\Traits\MessagesService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * signin a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin() {

        try {

            return $this->signinService()->signin();
        } catch (\Exception $ex) {
            $this->saveException($ex);
            return $this->jsonErrorResponse($ex->getMessage());
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
    public function edit($id) {
        //
    }

    /**
     * signup the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function signup() {
        try {
            return $this->signupService()->signupUser();
        } catch (\Exception $ex) {
            $this->saveException($ex);
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * logout the specified resource from session.
     * @return \Illuminate\Http\Response
     */
    public function logout() {

        \Session::flush();
        \Session::forget('favItems');
        $message = $this->getMessageData('success', app()->getLocale())['logout'];
        return redirect()->route('home', ['lang' => app()->getLocale()])->with('success_message', $message);
    }

}
