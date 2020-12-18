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
            if ($order->user->device->device_type != 'web') {
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
        $message_data['type'] = 'Your Order has been received by our team and we will process as soon as possible.';
        $message_data['message'] = 'Your Order has been received by our team and we will process as soon as possible.';
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
        $message_data['type'] = 'تم استلام طلبك من قِبل فريقنا وسنعالج في أسرع وقت ممكن';
        $message_data['message'] = 'تم استلام طلبك من قِبل فريقنا وسنعالج في أسرع وقت ممكن';
        return $message_data;
    }

    /**
     * 
     * @param type $message_data
     * @param type $badgeCount
     * @return array
     */
    public function setIosNotificationDataParameters($message_data, $badgeCount) {

        $message = array(
            'aps' => array(
                'alert' => $message_data['type'],
                'sound' => 'default',
                'content-available' => 1,
                'badge' => $badgeCount,
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
    public function sendPushNotificationToIOS($registrationId, $message_data) {
        $pemFile = public_path('ChbibPush.pem');
        $deviceToken = str_replace(array(' ', '<', '>'), '', $registrationId);
        $message = $this->setIosNotificationDataParameters($message_data, $badgeCount = 1);
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

}
