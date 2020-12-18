<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of PhomeNumberValidation
 *
 * @author qadeer
 */
use App\Http\Services\Config;

class PhomeNumberValidation extends Config {

    protected $validator;
    protected $geolocater;

    public function __construct() {
        $this->validator = \libphonenumber\PhoneNumberUtil::getInstance();
        $this->geolocater = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
    }

    /**
     * check phone Number Validation
     * @param type $phoneNumber
     * @return boolean
     */
    public function checkphoneNumberValidation($phoneNumber) {

        try {

            $swissNumberProto = $this->validator->parse($phoneNumber);
            $isValid = $this->validator->isValidNumber($swissNumberProto);
            if ($isValid == false) {
                return false;
            }
            return $isValid;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Get Phone Number Details
     * @param type $phoneNumber
     */
    public function getPhoneNumberDetails($phoneNumber) {

        try {
            $details = [];
            $swissNumberProto = $this->validator->parse($phoneNumber);
            $details['countryName'] = $this->geolocater->getDescriptionForNumber($swissNumberProto, "en_US");
            $details['countryCode'] = $swissNumberProto->getCountryCode();
            $details['nationNumber'] = $swissNumberProto->getNationalNumber();
            return $details;
        } catch (\Exception $ex) {
            return [];
        }
    }

}
