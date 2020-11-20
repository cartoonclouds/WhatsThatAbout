<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- FavIcons -->
    <link rel="shortcut icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">
    <link rel="icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script>
        window.csrf_token = '{{ csrf_token() }}';
        window.remember_token = '{{ user()->getRememberToken() }}';
    </script>
    <style>
        body {
            font-family: 'Roboto';
        }
    </style>
    @stack('styles')
</head>
<body class="sb-nav-fixed {{ !auth()->check() ? 'sb-sidenav-toggled' : '' }}">
    <div id="app">

        @include('layouts.navigation.topnav')

        @include('layouts.header')

        @include('flash::message')

        @auth
            <aside>

                @include('layouts.navigation.sidenav')

            </aside>
        @endauth

        <main class="main py-4 row" style="width:95%;margin:0 auto;flex: 1 0 auto;">

            <aside class="col-lg-2">

                @include('layouts.search')

            </aside>

            <div class="col-10 g-0">

                @yield('content')

            </div>

        </main>

        @include('layouts.footer')

    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#flash-overlay-modal').modal();

            $('.select2').select2();

            // Enable all tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            window.User = @json([
                'user' => Auth::user(),
                'signedIn' => Auth::check()
            ]);
        });
    </script>

    @stack('scripts')
</body>
</html>
