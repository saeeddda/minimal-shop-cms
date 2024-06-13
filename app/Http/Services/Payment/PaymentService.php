<?php

namespace App\Http\Services\Payment;

use App\Http\Services\Payment\Interfaces\IGateway;

class PaymentService implements IGateway
{
    private IGateway $gateway;

    public function __construct(IGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function requestPayment(int $amount, $description, $callback_url)
    {
        return $this->gateway->requestPayment($amount, $description, $callback_url);
    }

    public function verifyPayment(int $amount, $authority)
    {
        return $this->gateway->verifyPayment($amount, $authority);
    }

    public function redirectToGateway($authority)
    {
        return $this->gateway->redirectToGateway($authority);
    }

    public function getMessage($code)
    {
        return $this->gateway->getMessage($code);
    }
}
