<?php


namespace App\Http\Services;

use App\Http\Services\Config;


class BlackListEmail extends Config
{


    public function updateEmailResponse($input_params)
    {

        try {

            if ($input_params['response_type'] == 'Bounce') {
                $request_params['type'] = 'bounced';
            } elseif ($input_params['response_type'] == 'Complaint') {
                $request_params['type'] = 'complaint';
            }
            $userData = $this->getUserModel()->where('email', $input_params['response_email'])->first();
            if ($userData) {
                $request_params['email'] = $input_params['response_email'];
                $request_params['user_id'] = $userData->id;
                $save_respones = $this->getBlackEmailModel()->firstOrCreate($request_params);
                $userUpdate = $this->getUserModel()->where('id', $userData->id)->update(['email_status' => $request_params['type']]);
                if ($save_respones && $userUpdate) {
                    return 'success';
                } else {
                    return 'false';
                }
            }
        } catch (\Exception $ex) {

            return $this->storeException($ex);
        }
    }


}
