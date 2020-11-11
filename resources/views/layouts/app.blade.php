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
            font-family: 'Nunito';
        }
    </style>
    @stack('styles')
</head>
<body class="sb-nav-fixed {{ !auth()->check() ? 'sb-sidenav-toggled' : '' }}">
    <div>

{{--        @include('layouts.header')--}}


        @include('layouts.navigation.topnav')


        @include('flash::message')

        <div id="layoutSidenav" class="app">

            <div id="layoutSidenav_content">

                <main class="main py-4 row" style="width:90%;margin:auto;">

                    <aside class="col-2">
                        @include('layouts.search')
                    </aside>

                    <div class="col">
                        @yield('content')
                    </div>
                </main>

                @include('layouts.footer')
            </div>


            @auth
                <aside id="layoutSidenav_nav">

                    @include('layouts.navigation.sidenav')

                </aside>
            @endauth

        </div>





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
    </div>
</body>
</html>
