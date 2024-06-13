<?php

namespace App\Http\Services\Message\SMS;

use GuzzleHttp\Client;

class FarazSmsService{
    public function sendTextSmsWithApiKey($to, $text, $from){
        $client = new Client();
        $api_key = config('sms.api_key');
        return $client->request('POST', config('sms.text_sms_url'), [
            'json' => [
                "originator" => $from,
                "recipients" => [$to],
                "message" => $text
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "AccessKey $api_key"
            ],
            'http_errors' => false,
        ]);
    }

    public function sendPatternSmsWithApiKey($to, $values, $from, $patternCode){
        $client = new Client();
        $api_key = config('sms.api_key');
        return $client->request('POST', config('sms.pattern_sms_url'), [
            'json' => [
                "pattern_code" => $patternCode,
                "originator" => $from,
                "recipient" => $to,
                "values" =>  $values
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "AccessKey $api_key"
            ],
            'http_errors' => false,
        ]);

}
    public function getCreditWithApiKey(){
        $client = new Client();
        $api_key = config('sms.api_key');
        return $client->request('GET', config('sms.credit_url'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "AccessKey $api_key"
            ],
            'http_errors' => false,
        ]);
    }

    public function sendTextSms($to, $text){
        $client = new Client();
        return $client->request('POST', config('sms.default_sms_url'), [
            'json' => [
                'uname' => config('sms.username'),
                'pass' => config('sms.password'),
                'from' => config('sms.from'),
                'to' => $to,
                'message' => $text,
                'op' => 'send',
            ],
            'http_errors' => false,
        ]);
    }

    public function sendPatternSms($to, $code){
        $client = new Client();
        return $client->request('POST', config('sms.default_sms_url'), [
            'json' => [
                'uname' => config('sms.username'),
                'pass' => config('sms.password'),
                'from' => config('sms.from'),
                'to' => $to,
                'pattern_code' => config('sms.pattern_code'),
                'input_date' => [
                    'code' => $code
                ],
            ],
            'http_errors' => false,
        ]);
    }
}
