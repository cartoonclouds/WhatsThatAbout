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
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script>
        window.csrfToken =  '{{csrf_token()}}';
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">
    <link rel="icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>

    </style>
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

    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // Display flash modal
        $('#flash-overlay-modal').modal();

        console.table(new WTAApp({}));

        Inputmask().mask(document.querySelectorAll("input"));

        // Auto-close alerts
        const $alert = $('div.alert');//.not('.alert-important');

        // setTimeout(function() {
        //     $alert.addClass('fade');
        //     // $alert.alert('close');
        // }, 3500);

        // Enable all tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @stack('scripts')
</body>
</html>
