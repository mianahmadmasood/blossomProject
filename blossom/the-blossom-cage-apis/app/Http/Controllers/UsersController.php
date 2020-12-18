<?php

namespace App\Http\Controllers;

class UsersController extends Controller {

    function __construct() {

        $this->middleware(['api_auth']);
    }

    /**
     * signup method
     * this method is response fro user signup
     * @return JSON
     */
    public function signup() {
        try {
            return $this->getSignupService()->userSignup();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * login method
     * this method is response for user login
     * @return JSON
     */
    public function login() {
        try {
            return $this->getLoginService()->dologin();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Change user profile settings
     */
    public function getCountryAndCityInformation() {
        try {
            return $this->getProfileService()->getCountryAndCityInformation();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    public function signupForGuest() {
        try {
           
            return $this->guestUserSignupService()->makesignUpGuestUser();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    

}
