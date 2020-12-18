<?php

namespace App\Http\Controllers;

class ProfileController extends Controller {

    function __construct() {

        $this->middleware(['user_auth']);
    }

    /**
     * profile method
     * this method is response for profile
     * @return JSON
     */
    public function index() {
        try {
            return $this->getProfileService()->index();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * profile method
     * this method is response for profile
     * @return JSON
     */
    public function update() {
        try {
            return $this->getProfileService()->update();
        } catch (\Exception $ex) {
            return $this->storeException($ex);


        }
    }

    /**
     * passwordUpdate method
     * this method is response for update Password
     * @return JSON
     */
    public function passwordUpdate() {
        try {
            return $this->getProfileService()->passwordUpdate();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * Change user profile settings
     */
    public function settings() {
        try {
            return $this->getProfileService()->settings();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }


}
