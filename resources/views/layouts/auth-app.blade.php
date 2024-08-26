<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') {{ empty(env('APP_NAME'))?'': ' - '.env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.head_links')
    @yield('styles')
</head>

<body>
    <div class="login-container" style="background-image: url('{{url("assets/images/bg_login.jpg")}}')">
        @yield('content')
    </div>

    @include('layouts.scripts')
    @yield('scripts')
</body>
</html>
