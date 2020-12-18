<?php


namespace App\Http\Services;

use App\Http\Services\Config;
use Session;


class BlackListEmail extends Config {


    public function blackEmail($responseData) {
        $response = [];
        $response['response_type'] =$responseData['notificationType'];
        if($responseData['notificationType'] == 'Bounce'){
            $response['response_email']   =  $responseData['bounce']['bouncedRecipients'][0]['emailAddress'];
        }elseif($responseData['notificationType'] == 'Complaint'){
            $response['response_email']   =  $responseData['complaint']['complainedRecipients'][0]['emailAddress'];
        }
        $update_response = $this->updateEmailResponse($response);
        \Log::info($response);
        return $response;
    }

    /**
     * updateOrderTransaction
     * update order response from pay tabs
     */
    protected function updateEmailResponse($request_params)
    {

        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => 'en',
            ]
        ];
        return $this->guzzleRequest('sns-email-status-check', 'POST', $request_data);;
    }


}
