    <ul class="c-sidebar-nav">

        <!-- General Sidebar Links -->
        <li class="c-sidebar-nav-title">General</li>
        <x-nav.nav-item icon="{{ config('website.icons.home') }}" url="{{ url('/') }}">Home</x-nav.nav-item>

        <!-- Users Sidebar Links -->
        <li class="c-sidebar-nav-title">Users</li>
        <x-nav.nav-item icon="{{ config('website.icons.users.index') }}" url="{{ url('admin/users') }}">All Users</x-nav.nav-item>
        <x-nav.nav-item icon="{{ config('website.icons.users.create') }}" url="{{ url('admin/users/create') }}">Create User</x-nav.nav-item>

        <!-- Pages Sidebar Links -->
        <li class="c-sidebar-nav-title">Pages</li>
        <x-nav.nav-item icon="{{ config('website.icons.pages.index') }}" url="{{ url('admin/pages') }}">All Pages</x-nav.nav-item>
        <x-nav.nav-item icon="{{ config('website.icons.pages.create') }}" url="{{ url('admin/pages/create') }}">Create Page</x-nav.nav-item>

        <!-- Scenes Sidebar Links -->
        <li class="c-sidebar-nav-title">Scenes</li>
        <x-nav.nav-item icon="{{ config('website.icons.scenes.index') }}" url="{{ url('admin/scenes') }}">All Scenes</x-nav.nav-item>
        <x-nav.nav-item icon="{{ config('website.icons.scenes.create') }}" url="{{ url('admin/scenes/create') }}">Create Scene</x-nav.nav-item>

        <!-- Configuration Sidebar Links -->
        <li class="c-sidebar-nav-title">Configuration</li>
        <x-nav.nav-item icon="{{ config('website.icons.themes.index') }}" url="{{ url('admin/themes') }}">Themes</x-nav.nav-item>
        <x-nav.nav-item icon="{{ config('website.icons.genres.index') }}" url="{{ url('admin/genres') }}">Genres</x-nav.nav-item>
        <x-nav.nav-item icon="{{ config('website.icons.formats.index') }}" url="{{ url('admin/formats') }}">Formats</x-nav.nav-item>

    </ul>


{{--        <li class="c-sidebar-nav-item nav-dropdown">--}}
{{--            <a class="c-sidebar-nav-link nav-dropdown-toggle" href="#">--}}
{{--                <i class="c-sidebar-nav-icon cil-puzzle"></i> Nav dropdown--}}
{{--            </a>--}}
{{--            <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                <li class="c-sidebar-nav-item">--}}
{{--                    <a class="c-sidebar-nav-link" href="#">--}}
{{--                        <i class="c-sidebar-nav-icon cil-puzzle"></i> Nav dropdown item--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="c-sidebar-nav-item">--}}
{{--                    <a class="c-sidebar-nav-link" href="#">--}}
{{--                        <i class="c-sidebar-nav-icon cil-puzzle"></i> Nav dropdown item--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
