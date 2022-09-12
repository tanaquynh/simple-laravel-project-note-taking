<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Notes Taking' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">{{ $pageName }}</a>
            </div>

            <div class="card">
                <div class="p-4">
                    <img src="{{ asset('images/log.png') }}" class="img-fluid" alt="Login" style="object-fit: fill;">
                </div>
                <div class="card-body login-card-body ">
                    <p class="login-box-msg">{{ $message }}</p>
                    @yield('form')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>

</html>