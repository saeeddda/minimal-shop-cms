@extends('site.layouts.master-no-header-footer')
@section('title', 'فروشگاه آمازون')

@section('content')
    <form action="{{ route('site.auth.code-confirm.store', $token) }}" method="post">
        @csrf
        <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('site-assets/images/logo/4.png') }}" alt="">
                </section>
                <section class="login-title">تائید کد ورود/ثبت نام</section>
                <section class="login-info">کد ارسال شده به {{ $otp->login_phone_email }} را در قسمت زیر وارد کنید.</section>
                <section class="login-input-text">
                    <input type="text" name="code" value="{{ old('code') }}">
                    @error('code')
                        <p>{{ $message }}</p>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2">
                    <button type="submit" class="btn btn-danger">تائید کد</button>
                </section>
                <section class="mx-auto mb-3">
                    <span id="countdown"></span>
                    <a href="{{ route('site.auth.resend', $token) }}" id="resend_otp" class="btn btn-sm btn-outline-primary d-none">ارسال مجدد کد تائید</a>
                </section>
                <section class="login-btn d-grid g-2">
                    <a href="{{ route('site.auth.login-register') }}" class="btn btn-sm btn-outline-secondary">بازگشت</a>
                </section>
            </section>
        </section>
    </form>
@endsection

@section('site-scripts')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinute(3)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp
    <script>
        let countDownDate = new Date().getTime() + {{ $timer }};
        let timer = $('#countdown');
        let resend_otp = $('#resend_otp');

        let x = setInterval(function (){
            let now = new Date().getTime();
            let distance = countDownDate - now;
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(minutes === 0){
                timer.html('ارسال مجدد کد تائید تا ' + seconds + ' ثانیه دیگر');
            }else{
                timer.html('ارسال مجدد کد تائید تا ' + minutes + 'دقیقه و ' + seconds + 'ثانیه دیگر');
            }

            if(distance < 0){
                clearInterval(x);
                timer.addClass('d-none');
                resend_otp.removeClass('d-none');
            }
        }, 1000);
    </script>
@endsection
