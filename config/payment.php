<?php

return [
    'zarinpal' => [
        'merchant_id' => '1344b5d4-0048-11e8-94db-005056a205be',
//        'merchant_id' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
        'sandbox' => false,
        'lang' => 'fa',
        'zarin_gate' => true,
        'zarin_gate_psp' => 'Asan', // Asan, Sep, Sad, Pec, Fan, Emz
        'currency' => 'IRT',
        'api_url' => [
            'request' => 'https://api.zarinpal.com/pg/v4/payment/request.json',
            'verify' => 'https://api.zarinpal.com/pg/v4/payment/verify.json',
            'start_pay' => 'https://www.zarinpal.com/pg/StartPay/',
        ],
        'sandbox_url' => [
            'request' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
            'verify' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',
            'start_pay' => 'https://sandbox.zarinpal.com/pg/StartPay/',
        ],
    ]
];
