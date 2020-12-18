<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Profile
 *
 * @author qadeer
 */
use Auth;
use Hash;
use App\Http\Services\Config;
use Illuminate\Support\Facades\Validator;

class Profile extends Config {

    /**
     * render profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfileView() {

        return view('pages.profile.editProfile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile($request) {

        $request_params = $request->except('_token');

        $validate = Validator::make($request_params, $this->profile_update_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }

        if (!empty($request_params['image'])) {

            $upload = $this->uploadSingleImage($request_params['image'], $this->s3_image_paths['profile_images'], 'profile_');
            if ($upload['success']) {
                $request_params['image'] = $upload['file_name'];
            } else {
                return redirect()->back()->withInput($request_params)->with('error_message', "We are unable to write image data. Please try again.");
            }
        }
        $user = $this->getUserModel()->where('uuid', Auth::user()->uuid)->update($request_params);

        if ($user) {
            return $this->processUpdateProfile();
        }
    }

    /**
     * return user to related dashboard
     * @return type
     */
    protected function processUpdateProfile() {

        if (Auth::user()->role_id == 3) {

            return redirect()->route('employeeDashboard')->with('success_message', "Your profile has been update successfully.");
        } else {
            return redirect()->route('dashboard')->with('success_message', "Your profile has been update successfully.");
        }
    }

    public function changePassword() {
        return View('pages.profile.changePassword');
    }

    /**
     * updatePassword method 
     * 
     * @return type
     */
    public function updatePassword($request) {

        $request_params = $request->except('_token');

        $validate = Validator::make($request_params, $this->password_update_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }

        $user = $this->getUserModel()->getUserByColumnValue('id', Auth::user()->id);
        if (!Hash::check($request_params['old_password'], $user->password)) {

            return redirect()->back()->with('error_message', 'incorrect old password');
        }

        $user->password = \Hash::make($request_params['new_password']);
        if ($user->save()) {
            return $this->processUpdateProfile();
        }
        return redirect()->back()->withInput($request_params)->with('error_message', "Something went wrong");
    }

}
