<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? "What's That About?" }}</title>

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
    @show
</head>
<body class="antialiased">
    @include('flash::message')
    @include('layouts.header')

    <main class="main">
        @yield('content')
    </main>

    @include('layouts.footer')

    @section('scripts')
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            $('#flash-overlay-modal').modal();
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        </script>
    @show
</body>
</html>
