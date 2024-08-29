<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') {{ empty(env('APP_NAME')) ? '' : '- ' . env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.head_links')
    @yield('styles')
</head>

<body>
    <!--mobile header start-->


    <!--mobile header end-->


    <!--header area start-->
    @include('layouts.header')


    <!--mobile navigation bar start-->
    @include('layouts.mobile_menu')
    <!-- Sidebar -->
    @include('layouts.sidebar')


    <!-- GRAPHS -->
    <div class="content">
        @include('layouts.alerts')

        @yield('content')
    </div>

    <!-- GRAPHS END -->
    @include('layouts.scripts')
    @yield('scripts')
</body>

</html>
