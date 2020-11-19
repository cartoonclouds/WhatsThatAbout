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

        .text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}

        .text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}

        .text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}

        .text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}

        .text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}

        .text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}

        .text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}

        .page-title {
            transition: all 0.2s;
        }

        .card:hover .page-title {
            font-size: 1.5em;
            padding-top: .5em;
            padding-bottom: .5em;
            top: calc(150px - 2.25em);
        }

        .nav-link {
            padding: 0 0.25em 0.75em;
        }

        .nav-link.active {
            border-bottom: 2px solid;
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
