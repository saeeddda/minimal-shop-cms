<?php

namespace App\Http\Services\Payment\Gateways;

use App\Http\Services\Payment\Interfaces\IGateway;
use GuzzleHttp\Exception\RequestException;

class Zarinpal implements IGateway
{
    private $sandbox;
    private $merchant_id;
    private $currency;
    private $lang;
    private $zarin_gate;
    private $zarin_gate_psp;
    private $valid_zaring_gate_psp = ['Asan', 'Sep', 'Sad', 'Pec', 'Fan', 'Emz'];
    private $request_url;
    private $verify_url;
    private $start_pay_url;

    public function __construct()
    {
        $this->sandbox = config('payment.zarinpal.sandbox');
        $this->merchant_id = config('payment.zarinpal.merchant_id');
        $this->currency = config('payment.zarinpal.currency');
        $this->lang = config('payment.zarinpal.lang');
        $this->zarin_gate = config('payment.zarinpal.zarin_gate');
        $this->zarin_gate_psp = config('payment.zarinpal.zarin_gate_psp');

        if ($this->sandbox) {
            $this->request_url = config('payment.zarinpal.sandbox_url.request');
            $this->verify_url = config('payment.zarinpal.sandbox_url.verify');
            $this->start_pay_url = config('payment.zarinpal.sandbox_url.start_pay');
        } else {
            $this->request_url = config('payment.zarinpal.api_url.request');
            $this->verify_url = config('payment.zarinpal.api_url.verify');
            $this->start_pay_url = config('payment.zarinpal.api_url.start_pay');
        }
    }

    public function requestPayment(int $amount, $description, $callback_url)
    {

        $data = [
            'merchant_id' => $this->merchant_id,
            'amount' => $amount,
            'description' => $description,
            'currency' => $this->currency,
            'callback_url' => $callback_url
        ];

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->request_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response, true);

            if (count($response['errors']) == 0) {
                return $response['data'];
            } else {
                return $response['errors'];
            }
        } catch (RequestException $ex) {
            return $ex->getMessage();
        }
    }

    public function verifyPayment(int $amount, $authority): array
    {
        $data = [
            'merchant_id' => $this->merchant_id,
            'authority' => $authority,
            'amount' => $amount,
            'currency' => $this->currency
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->verify_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        if (count($response['errors']) == 0) {
            return $response['data'];
        } else {
            return $response['errors'];
        }
    }

    public function getMessage($code): string
    {
        $fa_messages = [
            '100' => 'عملیات موفق',
            '101' => 'تراکنش وریفای شده',
            '-9' => 'خطای اعتبار سنجی',
            '-10' => 'ای پی و يا مرچنت كد پذيرنده صحيح نيست',
            '-11' => 'مرچنت کد فعال نیست لطفا با تیم پشتیبانی ما تماس بگیرید',
            '-12' => 'تلاش بیش از حد در یک بازه زمانی کوتاه.',
            '-15' => 'ترمینال شما به حالت تعلیق در آمده با تیم پشتیبانی تماس بگیرید',
            '-16' => 'سطح تاييد پذيرنده پايين تر از سطح نقره اي است.',
            '-30' => 'اجازه دسترسی به تسویه اشتراکی شناور ندارید',
            '-31' => 'حساب بانکی تسویه را به پنل اضافه کنید مقادیر وارد شده واسه تسهیم درست نیست',
            '-32' => 'مقادیر وارد شده صحیح نیست',
            '-33' => 'درصد های وارد شده درست نیست',
            '-34' => 'مبلغ از کل تراکنش بیشتر است',
            '-35' => 'تعداد افراد دریافت کننده تسهیم بیش از حد مجاز است',
            '-40' => 'پارامتر اضافی نامعتبر',
            '-50' => 'مبلغ پرداخت شده با مقدار مبلغ در وریفای متفاوت است',
            '-51' => 'پرداخت ناموفق',
            '-52' => 'خطای غیر منتظره با پشتیبانی تماس بگیرید',
            '-53' => 'اتوریتی برای این مرچنت کد نیست',
            '-54' => 'اتوریتی نامعتبر است',
        ];

        $en_messages = [
            '100' => 'Success',
            '101' => 'Verified',
            '-9' => 'Validation error',
            '-10' => 'Terminal is not valid, please check merchant_id or ip address.',
            '-11' => 'Terminal is not active, please contact our support team.',
            '-12' => 'To many attempts, please try again later.',
            '-15' => 'Terminal user is suspend : (please contact our support team).',
            '-16' => 'Terminal user level is not valid : ( please contact our support team).',
            '-30' => 'Terminal do not allow to accept floating wages.',
            '-31' => 'Terminal do not allow to accept wages, please add default bank account in panel.',
            '-32' => 'Wages is not valid, Total wages(floating) has been overload max amount.',
            '-33' => 'Wages floating is not valid.',
            '-34' => 'Wages is not valid, Total wages(fixed) has been overload max amount.',
            '-35' => 'Wages is not valid, Total wages(floating) has been reached the limit in max parts.',
            '-40' => 'Invalid extra params, expire_in is not valid.',
            '-50' => 'Session is not valid, amounts values is not the same.',
            '-51' => 'Session is not valid, session is not active paid try.',
            '-52' => 'Oops!!, please contact our support team',
            '-53' => 'Session is not this merchant_id session',
            '-54' => 'Invalid authority.',
        ];

        return $this->lang == 'fa' ? $fa_messages[$code] : $en_messages[$code];
    }

    public function redirectToGateway($authority)
    {
        $zarin_gate_url = $this->zarin_gate ? '/ZarinGate' : '';

        if($this->zarin_gate && trim($this->zarin_gate_psp) != '' && in_array($this->zarin_gate_psp, $this->valid_zaring_gate_psp)){
            $zarin_gate_url = '/' . $this->zarin_gate;
        }

        $url = $this->start_pay_url . $authority . $zarin_gate_url;
        return redirect($url);
    }
}
