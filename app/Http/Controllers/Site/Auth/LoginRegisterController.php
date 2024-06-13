<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\CodeConfirmationRequest;
use App\Http\Requests\Site\Auth\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    public function loginRegister(){
        return view('site.auth.login-register');
    }

    public function loginRegisterStore(LoginRegisterRequest $request){
        $inputs = $request->all();

        if(filter_var($inputs['phone_email'], FILTER_VALIDATE_EMAIL)){
            $type = 1;
            $user = User::where(['email' => $inputs['phone_email']])->first();
            if(empty($user)){
                $newUser['email'] = $inputs['phone_email'];
            }
        }elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['phone_email'])){
            $type = 0;
            $inputs['phone_email'] = ltrim($inputs['phone_email'], '0');
            $inputs['phone_email'] = substr($inputs['phone_email'], 0, 2) === '98' ? substr($inputs['phone_email'], 2) : $inputs['phone_email'];
            $inputs ['phone_email'] = str_replace('+98', '', $inputs['phone_email']);

            $user = User::where(['mobile' => $inputs['phone_email']])->first();
            if(empty($user)){
                $newUser['mobile'] = $inputs['phone_email'];
            }
        }else{
            return redirect()->route('site.auth.login-register')->withErrors(['phone_email' => 'اطلاعات وارد شده معتبر نمیباشد']);
        }

        if(empty($user)){
            $newUser['password'] = Str::random(10);
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

        $otpCode = rand(000000, 999999);
        $token = Str::random(60);
        $optInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_phone_email' => $inputs['phone_email'],
            'type' => $type,
        ];

        Otp::create($optInputs);

        if($type == 0) {
            //Create an instance SmsService to provide sms info
            $smsService = new SmsService();
            $smsService->setFrom(config('sms.from'));
            $smsService->setPatternCode(config('sms.patterns.verify'));
            $smsService->setTo('0' . $user->mobile);
            $smsService->isPattern(true);
            $smsService->setValues([
                'code' => strval($otpCode), // Just string key and value supported
            ]);

            //Create an instance MessageService to send sms
            $messageService = new MessageService($smsService);
            $messageService->send();

        }elseif($type == 1){
            //Create an instance EmailService to provide email details
            $emailService = new EmailService();
            $emailService->setDetails([
                'title' => 'ایمیل فعالسازی',
                'body' => "کد فعالسازی شما $otpCode میباشد."
            ]);
            $emailService->setFrom('noreplay@localhost.net', 'localhost');
            $emailService->setSubject('Activation code');
            $emailService->setTo($inputs['phone_email']);

            //Create an instance MessageService to send sms
            $messageService = new MessageService($emailService);
            $messageService->send();
        }

        return redirect()->route('site.auth.code-confirm', compact('token'));
    }

    public function codeConfirm($token){
        $otp = Otp::where(['token' => $token])->first();

        if (empty($otp)){
            return redirect()->route('site.auth.login-register')->withErrors('آدرس وارد شده نامعتبر میباشد. مجدد تلاش کنید');
        }

        return view('site.auth.code-confirm', compact('token', 'otp'));
    }

    public function codeConfirmStore($token, CodeConfirmationRequest $request){
        $inputs = $request->all();

        $otp = Otp::where('token', $token)
            ->where('used', 0)
            ->where('created_at', '>=', Carbon::now()->subMinute(3)->toDateTimeString())
            ->first();

        if(empty($otp)){
            return redirect()->route('site.auth.login-register')->withErrors('آدرس وارد شده نامعتبر میباشد');
        }

        if($otp->otp_code != $inputs['code']){
            return redirect()->route('site.auth.code-confirm', $token)->withErrors('کد وارد شده صحیح نمیباشد');
        }

        $otp->update(['used' => 1]);
        $user = $otp->user;

        if($otp->type == 0 && empty($user->mobile_verified_at)){
            $user->update(['phone_verified_at' => Carbon::now()]);
            $user->update(['mobile_verified_at' => Carbon::now()]);
        }elseif($otp->type == 1 && empty($user->email_verified_at)){
            $user->update(['email_verified_at' => Carbon::now()]);
        }

        auth()->login($user);

        return redirect()->route('site.home');
    }

    public function resendCode($token){
        $otp = Otp::where('token', $token)
            ->where('created_at', '<=', Carbon::now()->subMinute(3)->toDateTimeString())
            ->first();

        if (empty($otp)){
            return redirect()->route('site.auth.login-register')->withErrors('آدرس وارد شده نامعتبر میباشد');
        }

        $user = $otp->user;
        $otpCode = rand(000000, 999999);
        $newToken = Str::random(60);
        $optInputs = [
            'token' => $newToken,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_phone_email' => $otp->login_phone_email,
            'type' => $otp->type,
        ];

        Otp::create($optInputs);

        if($otp->type == 0) {
            //Create an instance SmsService to provide sms info
            $smsService = new SmsService();
            $smsService->setFrom(config('sms.from'));
            $smsService->setPatternCode(config('sms.patterns.verify'));
            $smsService->isPattern(true);
            $smsService->setTo('0' . $user->mobile);
            $smsService->setValues([
                'code' => strval($otpCode), // Just string key and value supported
            ]);

            //Create an instance MessageService to send sms
            $messageService = new MessageService($smsService);
            $messageService->send();

        }elseif($otp->type == 1){
            //Create an instance EmailService to provide email details
            $emailService = new EmailService();
            $emailService->setDetails([
                'title' => 'ایمیل فعالسازی',
                'body' => "کد فعالسازی شما $otpCode میباشد."
            ]);
            $emailService->setFrom('noreplay@localhost.net', 'localhost');
            $emailService->setSubject('Activation code');
            $emailService->setTo($otp->login_phone_email);

            //Create an instance MessageService to send sms
            $messageService = new MessageService($emailService);
            $messageService->send();
        }

        return redirect()->route('site.auth.code-confirm', $newToken);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('site.home');
    }
}
