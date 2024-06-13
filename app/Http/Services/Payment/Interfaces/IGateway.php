<?php

namespace App\Http\Services\Payment\Interfaces;

interface IGateway{
    function requestPayment(int $amount, $description, $callback_url);

    function verifyPayment(int $amount, $authority);

    function redirectToGateway($authority);

    function getMessage($code);
}
