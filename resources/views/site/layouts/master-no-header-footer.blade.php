<!doctype html>
<html lang="fa" dir="rtl">
<head>
    @include('site.layouts.header-tags')
    <title>@yield('title', 'فروشگاه')</title>
    @yield('site-styles')
</head>
<body>
    @yield('content')
    @include('site.layouts.footer-tags')
    @yield('site-scripts')
</body>
</html>
