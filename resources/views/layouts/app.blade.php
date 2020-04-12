<!doctype html>
<html lang="en">
<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', $title ?? '') }}</title>

        <!-- Scripts -->
        <script src="{{ mix('js/bootstrap.js') }}"></script>
        <script>
            window.csrfToken = '{{csrf_token()}}';
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">
        <link rel="icon" href="{{ config('site.favicon-url') }}" type="image/x-icon">

        <!-- Material Design for Bootstrap fonts and icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <style>

        </style>
    @show
</head>
<body>
    <i class="fas fa-user"></i> <!-- uses solid style -->
    <i class="far fa-user"></i> <!-- uses regular style -->
    <i class="fal fa-user"></i> <!-- uses light style -->
    <!--brand icon-->
    <i class="fab fa-github-square"></i> <!-- uses brands style -->
    <div id="app">
        <div class="bmd-layout-container bmd-drawer-f-l">
            @include('layouts.header')
            @include('layouts.partials.drawer')
            <main class="bmd-layout-content">
                <div class="main py-4 container-fluid">
                    @include('flash::message')
                    @yield('content')
                </div>
            </main>
        </div>
        @include('layouts/footer')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // Display flash modal
        $('#flash-overlay-modal').modal();

        console.table(new WTAApp({}));

        // Auto-close alerts
        // const $alert = $('div.alert');//.not('.alert-important');

        // setTimeout(function() {
        //     $alert.addClass('fade');
        //     // $alert.alert('close');
        // }, 3500);

        // Enable all tooltips
        $('[data-toggle="tooltip"]').tooltip();
    </script>
    @stack('scripts')
</body>
</html>
