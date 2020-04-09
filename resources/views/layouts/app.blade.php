<!doctype html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', $title ?? '') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">
    <link rel="icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @show
</head>
<body>
    <div id="app">
        @include('layouts/header-nav')

        @include('flash::message')

        <main class="main py-4">
            @yield('content')
        </main>

        @include('layouts/footer')

        @stack('scripts')
    </div>
</body>
</html>
