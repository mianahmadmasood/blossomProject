<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

    /**
     * Render home page for web side
     */
    public function index() {
        try {

            return $this->home()->index();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    public function emailResponse(Request $request) {

        $data = $request->getContent();
        $dataInArray = json_decode($data,true);
       if(!empty($phpArray['Message'])) {
           $responseData = json_decode($dataInArray['Message'], true);
       }else{
           $responseData = $dataInArray;
       }

        try {
            return $this->getBlackListEmailService()->blackEmail($responseData);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }

    }




    /**
     * change website langaue
     */
    public function changeLocale() {
        try {
            return $this->home()->changeLocale();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }
    /**
     * change website langaue
     */
//    public function rocketapi() {
//        try {
//            return $this->home()->getrocketapi();
//        } catch (\Exception $ex) {
//            return $this->storeException($ex);
//        }
//    }
    /**
     * change website langaue
     */
    public function localeCurrentValue() {
        try {
            return $this->home()->localeCurrentValue();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * change website Currency
     */
    public function changeCurrency() {
        try {
            return $this->home()->changeCurrency();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    /**
     * render about page
     * @return type
     */
    public function about() {
        try {
            return $this->home()->about();
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

}
