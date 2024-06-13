<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('site.layouts.header-tags')
    <title>@yield('title', 'فروشگاه')</title>
    @yield('site-styles')
</head>
<body>
    @include('site.layouts.header')

    @yield('content')

    @include('site.layouts.footer')

    @include('site.layouts.footer-tags')
    @yield('site-scripts')
</body>
</html>
