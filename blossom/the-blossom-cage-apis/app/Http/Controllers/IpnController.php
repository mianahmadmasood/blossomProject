<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class IpnController extends Controller {

    /**
     * save response posted by paytabs
     *
     * @return bol
     */
    public function saveIpnResponse(Request $request) {
        try {
            return $this->getPaytabsService()->storeTransactionData($request);
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }

    public function emailResponse(Request $request) {
        try {

            return $this->getBlackListEmailService()->updateEmailResponse($request->all());
        } catch (\Exception $ex) {
            return $this->storeException($ex);
        }
    }


}
