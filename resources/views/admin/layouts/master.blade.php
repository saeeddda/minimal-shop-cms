<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>

    @include('admin.layouts.head-tags')
    @yield('admin-styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- @include('admin.layouts.preloader') --}}
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div class="content-wrapper">
{{--            @include('admin.layouts.sidebar')--}}

            @yield('content')
        </div>

        @include('admin.layouts.footer')

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    @include('admin.layouts.footer-tags')

    @yield('admin-scripts')

    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.warning')
</body>

</html>
