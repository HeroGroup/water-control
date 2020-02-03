<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function send($title, $msg, $topic=null, $token=null)
    {
        try {
            $API_KEY = env('FCM_API_KEY');
            if (!$API_KEY)
                $message = 'خطا در ارسال نوتیفیکیشن';

            $header = [
                'Authorization'=> 'key='.$API_KEY,
                'Content-Type' => 'application/json'
            ];

            $body = [];
            if ($token)
                $body['to'] = $token;
            else if ($topic)
                $body['to'] = "topic/$topic";

            $body['notification'] = [
                'title' => $title,
                'body' => $msg,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            $result = curl_exec($ch);
            curl_close($ch);
            $message = "پیام با موفقیت ارسال شد به $token";

        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        } finally {
            return $message;
        }
    }
}
