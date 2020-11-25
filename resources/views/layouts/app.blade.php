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

        #body-row {
            margin-left:0;
            margin-right:0;
        }

        #sidebar-container {
            min-height: 100vh;
            background-color: #333;
            padding: 0;
        }

        /* Sidebar sizes when expanded and expanded */
        .sidebar-expanded {
            width: 230px;
        }
        .sidebar-collapsed {
            width: 60px;
        }

        /* Menu item*/
        /*#sidebar-container li + .list-group-item,*/
        /*#sidebar-container .list-group-item:first-of-type {*/
        /*    padding-top: 1em;*/
        /*    padding-bottom: 1em;*/
        /*}*/

        #sidebar-container .list-group a {
            height: 50px;
            color: white;
        }

        /* Submenu item*/
        #sidebar-container .list-group .sidebar-submenu a {
            height: 45px;
            padding-left: 30px;
        }
        .sidebar-submenu {
            font-size: 0.9rem;
        }

        /* Separators */
        .sidebar-separator-title {
            background-color: #333;
            height: 35px;
        }
        .sidebar-separator {
            background-color: #333;
            height: 25px;
        }
        .logo-separator {
            background-color: #333;
            height: 60px;
        }

        /* Closed submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
            content: " \f0d7";
            font-family: "Font Awesome 5 Pro";
            display: inline;
            text-align: right;
            padding-left: 10px;
            font-weight: bold;
        }
        /* Opened submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
            content: " \f0da";
            font-family: "Font Awesome 5 Pro";
            display: inline;
            text-align: right;
            padding-left: 10px;
            font-weight: bold;
        }

        /** image-upload component styles */
        label:hover {
            color: #fff !important;
        }
        /*for dark background inputs
        ::selection {
            background: #fff;
            color: #000;
            text-shadow: none;
        }*/
    </style>


    @stack('styles')
</head>
<body class="vh-100">
    <div id="app" class="h-100">

    <header>
        @include('layouts.navigation.topnav')

        @include('layouts.header')
    </header>

    <main class="main row" id="body-row">

        @hasanyrole($allRoles->implode('|'))
            @include('layouts.navigation.sidenav')
        @endhasanyrole


        <!-- MAIN -->
        <div class="col row p-4 mx-0">

            <aside class="col-lg-2">
                @include('layouts.search')
            </aside>

            <div class="col">
                @include('flash::message')

                @hasanyrole($adminRoles->implode('|'))
                    <div class="alert alert-info mb-3">
                        <i class="fa fa-exclamation"></i> Hey! You're a {{ user()->roles->first()->pretty_name }}, why not <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">create a new page</a>?
                    </div>
                @endhasanyrole

                @yield('content')

            </div>

        </div><!-- Main Col END -->


    @auth
</div><!-- body-row END -->
@endauth

</main>

@include('layouts.footer')

</div>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function() {

        // Hide submenus
        $('#body-row .collapse').collapse('hide');

        // Collapse/Expand icon
        $('#collapse-icon').addClass('fa-angle-double-left');

        // Collapse click
        $('[data-toggle=sidebar-collapse]').click(function() {
            SidebarCollapse();
        });

        function SidebarCollapse (e) {
            $('.menu-collapsed').toggleClass('d-none');
            $('.sidebar-submenu').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

            // Treating d-flex/d-none on separators with title
            var SeparatorTitle = $('.sidebar-separator-title');

            if ( SeparatorTitle.hasClass('d-flex') ) {
                SeparatorTitle.removeClass('d-flex');
            } else {
                SeparatorTitle.addClass('d-flex');
            }

            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        }
            /**
             * Setup Inputmask
             */
            Inputmask().mask(document.querySelectorAll('input'));



        $('#flash-overlay-modal').modal();

        // $('.select2').select2();

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
