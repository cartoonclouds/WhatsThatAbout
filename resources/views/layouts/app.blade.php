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

        .post-excerpt .bd-placeholder-img {
            display: flex;
            width: 100%;
            height: 100%;
            position: relative;
            justify-content: center;
            align-items: center;
            transition: 0.4s ease;
        }
        .post-excerpt .bd-placeholder-img i {
            opacity: 0;
            transition: 0.4s ease;
        }
        .post-excerpt .bd-placeholder-img svg {
            opacity: 1;
        }

        .post-excerpt .bd-placeholder-img:hover {
            box-shadow: 0 0 20px 0 rgba(255,88,96,0.5);
            background-color: rgba(255,88,96,0.5);
        }

        .post-excerpt .bd-placeholder-img:hover i {
            opacity: 1;
        }
        .post-excerpt .bd-placeholder-img:hover svg {
            opacity: 0;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
    @stack('styles')
</head>
<body class="c-app">


    @hasanyrole($adminRoles->implode('|'))
    <div id="sidebar" class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show">
        <div class="c-sidebar-brand d-md-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
            </svg>
        </div>

        @include('layouts.navigation.sidenav')

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    @endhasanyrole

    <div class="c-wrapper">
        <header class="c-header c-header-dark c-header-fixed">
            @include('layouts.navigation.topnav')

{{--            @include('layouts.header')--}}
        </header>

        <div class="c-body">
            <main class="c-main">

                <div class="container-fluid">
                    <div class="fade-in">
                        <div class="row">

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

                        </div>
                    </div>
                </div>

            </main>

        </div>


        <footer class="c-footer mt-4">
            @include('layouts.footer')
        </footer>
    </div>


</body>

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
