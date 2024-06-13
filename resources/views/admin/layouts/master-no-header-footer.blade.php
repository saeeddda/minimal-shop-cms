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
        <div class="">

            @yield('content')

        </div>
    </div>

    @include('admin.layouts.footer-tags')

    @yield('admin-scripts')
</body>

</html>
