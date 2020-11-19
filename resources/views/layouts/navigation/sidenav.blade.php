<nav class="sb-sidenav sb-sidenav-light sb-sidenav-dark accordion" id="sidenavAccordion">

    <button class="btn btn-link btn-outline-light" id="sidebarToggle"><i class="fas fa-bars"></i></button>

    <div class="sb-sidenav-menu">
        <div class="nav" style="padding-left: 1em;">
            <div class="sb-sidenav-menu-heading">General</div>
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.home') }}"></i></div>Home
                </a>

            <div class="sb-sidenav-menu-heading">Users</div>
                <a class="nav-link" href="{{ url('users') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.users.index') }}"></i></div>All Users
                </a>
                <a class="nav-link" href="{{ url('users/create') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.users.create') }}"></i></div>Create User
                </a>

            <div class="sb-sidenav-menu-heading">Pages</div>
                <a class="nav-link" href="{{ url('pages') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.pages.index') }}"></i></div>All Pages
                </a>
                <a class="nav-link" href="#"  @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.pages.create') }}"></i></div>Create Pages
                </a>

            <div class="sb-sidenav-menu-heading">Segments</div>
                <a class="nav-link" href="{{ url('segments') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.segments.index') }}"></i></div>All Segments
                </a>
                <a class="nav-link" href="#"  @click="$bus.$emit('update-or-create', {{ new \App\Models\Segment }})">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.segments.create') }}"></i></div>Create Segment
                </a>

            <div class="sb-sidenav-menu-heading">Configuration</div>
                <a class="nav-link" href="{{ url('themes') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.themes.index') }}"></i></div>Themes
                </a>
                <a class="nav-link" href="{{ url('genres') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.genres.index') }}"></i></div>Genres
                </a>
                <a class="nav-link" href="{{ url('formats') }}">
                    <div class="sb-nav-link-icon"><i class="{{ config('website.icons.formats.index') }}"></i></div>Formats
                </a>


{{--            <div class="sb-sidenav-menu-heading">Pages</div>--}}
{{--                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Layouts--}}
{{--                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                </a>--}}
{{--                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">--}}
{{--                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.html">Static Navigation</a><a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a></nav>--}}
{{--                </div>--}}
{{--                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">--}}
{{--                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>Pages--}}
{{--                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--                </a>--}}
{{--                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">--}}
{{--                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages"><a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Authentication<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>--}}
{{--                        <div--}}
{{--                            class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">--}}
{{--                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.html">Login</a><a class="nav-link" href="register.html">Register</a><a class="nav-link" href="password.html">Forgot Password</a></nav>--}}
{{--                        </div><a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Error<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>--}}
{{--                        <div--}}
{{--                            class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">--}}
{{--                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>--}}
{{--                        </div>--}}
{{--                    </nav>--}}
{{--                </div>--}}

        </div>
    </div>

    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>Start Bootstrap
    </div>
</nav>
