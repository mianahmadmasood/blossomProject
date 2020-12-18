<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait NotificationService {

    /**
     * 
     * @param type $order
     * @return boolean
     */
    public function sendNotification($order) {

        if (!empty($order->user->device)) {
            if ($order->user->device->device_type != 'web' && !empty($order->user->setting) && $order->user->setting->push_notification == 1) {
                $notification_message = $this->prepareNotificationMessage($order);
                if ($order->user->device->device_type == 'ios') {
                    $this->sendPushNotificationToIOS($order->user->device->device_token, $notification_message);
                }
                if ($order->user->device->device_type == 'android') {
                    $this->sendPushNotificationToAndroid($order->user->device->device_token, $notification_message);
                }
            }
        }
        return true;
    }

    /**
     * @param type $order
     * @return type
     */
    public function prepareNotificationMessage($order) {

        $message = [];
        $message['order_id'] = $order->uuid;
        $message = $this->selectLangaueForMessage($message, $order);
        return $message;
    }

    /**
     * 
     * @param type $message_data
     * @param type $order
     * @return type
     */
    public function selectLangaueForMessage($message_data, $order) {
        if (!empty($order->user->lang) && $order->user == 'ar') {
            $message_data = self::selectTypeAndMessageDataForAR($message_data, $order);
        } else {
            $message_data = self::selectTypeAndMessageDataForEN($message_data, $order);
        }
        return $message_data;
    }

    /**
     * selectTypeAndMessageDataForCarrierEN method
     * @param type $message_data
     * @param type $sender_info
     * @param type $status
     * @return string
     */
    public function selectTypeAndMessageDataForEN($message_data, $order) {
        $message_data['title'] = 'Order Info';
        if ($order->order_status_id == 2) {
            $message_data['type'] = 'Your Order has been accepted by our team and we will process as soon as possible.';
            $message_data['message'] = 'Your Order has been accepted by our team and we will process as soon as possible.';
        }
        if ($order->order_status_id == 3) {
            $message_data['type'] = 'Your Order has been dispatched. It will be on your door step soon.';
            $message_data['message'] = 'Your Order has been dispatched. It will be on your door step soon.';
        }
        if ($order->order_status_id == 4) {
            $message_data['type'] = 'Your Order has been delivered on its destination. Have Fun!';
            $message_data['message'] = 'Your Order has been delivered on its destination. Have Fun!';
        }if ($order->order_status_id == 5) {
            $message_data['type'] = 'Your Order has been Cancelled. ';
            $message_data['message'] = 'Your Order has been Cancelled.';
        }

        return $message_data;
    }

    /**
     * selectTypeAndMessageDataForCarrierAR method
     * @param type $message_data
     * @param type $sender_info
     * @param type $status
     * @return string
     */
    public static function selectTypeAndMessageDataForAR($message_data, $order) {
        $message_data['title'] = 'معلومات الحزمة';
        if ($order->order_status_id == 2) {
            $message_data['type'] = 'تم قبول طلبك من قِبل فريقنا وسنعالج في أسرع وقت ممكن';
            $message_data['message'] = 'تم قبول طلبك من قِبل فريقنا وسنعالج في أسرع وقت ممكن';
        }
        if ($order->order_status_id == 3) {
            $message_data['type'] = 'لقد تم إرسال طلبك. سيكون على عتبة داركم قريبا';
            $message_data['message'] = 'لقد تم إرسال طلبك. سيكون على عتبة داركم قريبا';
        }
        if ($order->order_status_id == 4) {
            $message_data['type'] = 'تم تسليم طلبك في وجهته. إستمتع!';
            $message_data['message'] = 'تم تسليم طلبك في وجهته. إستمتع!';
        }if ($order->order_status_id == 5) {
            $message_data['type'] = 'تم إلغاء طلبك.';
            $message_data['message'] = 'تم إلغاء طلبك.';
        }
        return $message_data;
    }

    /**
     * 
     * @param type $device_token
     * @param type $message_data
     */
    public function setIosNotificationDataParameters($message_data) {

        $message = array(
            'aps' => array(
                'alert' => $message_data['type'],
                'sound' => 'default',
                'content-available' => 1,
                'badge' => 1,
            ),
            'type' => 'Order',
            'data' => $message_data
        );
        return $message;
    }

    /**
     * Send Notification to ios
     * @param type $registrationId
     * @param type $message_data
     * @return boolean
     */
    public function sendPushNotificationToIOSOld($registrationId, $message_data) {
        $pemFile = public_path('ChbibPush.pem');
        $deviceToken = str_replace(array(' ', '<', '>'), '', $registrationId);
        $message = $this->setIosNotificationDataParameters($message_data, $badgeCount = 3);
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pemFile);
        stream_context_set_option($ctx, 'ssl', 'passphrase', 'push');
        $fp = stream_socket_client(
//                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx
                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx
        );
        $payload = json_encode($message);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));

        fclose($fp);
        return true;
    }

    /**
     * Send Notification to Android
     * @param type $registrationIds
     * @param type $message_data
     * @return boolean
     */
    public function sendPushNotificationToAndroid($registrationIds, $message_data) {
       
        $APPYKEY = 'AAAARjHzyW4:APA91bEHm8M3s8n8QYdiLSui6EkRA7s2W69D4G70NN-6vb6-1-dNotlohqD80LYB-LFiT_Q5tBTI1ZJzVqUeuOPJlaPWBQ4Nf2r7__tCTkqGRqKlX5NuemRciffTrRHrPOP4lMUha3Ve';
       
        $fields = [
            'registration_ids' => [$registrationIds],
            'data' => $message_data
        ];
        $headers = [
            'Authorization: key=' . $APPYKEY,
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    /**
     * sendPushNotificationToIOS new using .p8 file
     * @param type $registrationId
     * @param type $message_data
     * @return boolean
     */
    public function sendPushNotificationToIOS($registrationId, $message_data) {

        $keyfile = public_path('AuthKey_GT3JD8ACRU.p8');
        $keyid = 'GT3JD8ACRU';
        $teamid = '4P2Z6U362R';
        $bundleid = 'com.ilsa.chbib';
//        $url = 'https://api.development.push.apple.com';
        $url = 'https://api.push.apple.com';
        $token = $registrationId;
        $message = json_encode($this->setIosNotificationDataParameters($message_data, $badgeCount = 3));
        $key = openssl_pkey_get_private('file://' . $keyfile);
        $header = ['alg' => 'ES256', 'kid' => $keyid];
        $claims = ['iss' => $teamid, 'iat' => time()];
        $header_encoded = $this->base64($header);
        $claims_encoded = $this->base64($claims);
        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);

        $http2ch = curl_init();
        curl_setopt_array($http2ch, array(
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_URL => "$url/3/device/$token",
            CURLOPT_PORT => 443,
            CURLOPT_HTTPHEADER => array(
                "apns-topic: {$bundleid}",
                "authorization: bearer $jwt"
            ),
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $message,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HEADER => 1
        ));

        $result = curl_exec($http2ch);
//        if ($result === FALSE) {
//            echo "<pre>";
//            print_r("Curl failed: " . curl_error($http2ch));
//            exit;
//        }
//        $status = curl_getinfo($http2ch, CURLINFO_HTTP_CODE);
        return true;
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function base64($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    }

}
