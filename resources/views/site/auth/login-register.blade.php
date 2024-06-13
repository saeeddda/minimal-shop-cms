@extends('site.layouts.master-no-header-footer')
@section('title', 'فروشگاه آمازون')

@section('content')
    <form action="{{ route('site.auth.login-register.store') }}" method="post">
        @csrf
        <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
            <section class="login-wrapper mb-5">
                <section class="login-logo">
                    <img src="{{ asset('site-assets/images/logo/4.png') }}" alt="">
                </section>
                <section class="login-title">ورود / ثبت نام</section>
                <section class="login-info">شماره موبایل یا پست الکترونیک خود را وارد کنید</section>
                <section class="login-input-text">
                    <input type="text" name="phone_email" value="{{ old('phone_email') }}" placeholder="09120000000 یا example@email.com">
                    @error('phone_email')
                        <p>{{ $message }}</p>
                    @enderror
                </section>
                <section class="login-btn d-grid g-2"><button type="submit" class="btn btn-danger">ورود به آمازون</button></section>
                <section class="login-terms-and-conditions"><a href="#">شرایط و قوانین</a> را خوانده ام و پذیرفته ام</section>
            </section>
        </section>
    </form>
@endsection
