<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="remember-token" content="{{ user()->getRememberToken() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- FavIcons -->
    <link rel="shortcut icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">
    <link rel="icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">
    @include('flash::message')

    @include('layouts.header')

    <main id="app" class="main" style="width:60%;margin:0 auto;">
        @yield('content')
    </main>

    @stack('modals')

    @include('layouts.footer')

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
    <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        window.User = @json([
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ])
    </script>
</body>
</html>
