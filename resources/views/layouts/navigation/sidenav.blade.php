<!-- Sidebar -->
<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
    <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
    <!-- Bootstrap List Group -->
    <ul class="list-group">

            <a href="{{ url('/') }}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <i class="{{ config('website.icons.home') }} fa-fw mr-3"></i>
                    <span class="menu-collapsed">Home</span>
                </div>
            </a>

{{--        <!-- Separator with title -->--}}
{{--        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">--}}
{{--            <small>MAIN MENU</small>--}}
{{--        </li>--}}
{{--        <!-- /END Separator -->--}}
{{--        <!-- Menu with submenu -->--}}
{{--        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">--}}
{{--            <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                <i class="{{ config('website.icons.home') }} fa-fw mr-3"></i>--}}
{{--                <span class="menu-collapsed">Home</span>--}}
{{--                <span class="submenu-icon ml-auto"></span>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <!-- Submenu content -->--}}
{{--        <div id='submenu1' class="collapse sidebar-submenu">--}}
{{--            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                <span class="menu-collapsed">Chahgag</span>--}}
{{--            </a>--}}
{{--            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                <span class="menu-collapsed">Reports</span>--}}
{{--            </a>--}}
{{--            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                <span class="menu-collapsed">Tables</span>--}}
{{--            </a>--}}
{{--        </div>--}}


{{--        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">--}}
{{--            <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                <span class="fa fa-user fa-fw mr-3"></span>--}}
{{--                <span class="menu-collapsed">Profile</span>--}}
{{--                <i class="fas fa-caret-down"></i>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <!-- Submenu content -->--}}
{{--        <div id='submenu2' class="collapse sidebar-submenu">--}}
{{--            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                <span class="menu-collapsed">Settings</span>--}}
{{--            </a>--}}
{{--            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">--}}
{{--                <span class="menu-collapsed">Password</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--            <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                <span class="fa fa-tasks fa-fw mr-3"></span>--}}
{{--                <span class="menu-collapsed">Tasks</span>--}}
{{--            </div>--}}
{{--        </a>--}}


        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Users</small>
        </li>
        <!-- /END Separator -->
        <a href="{{ url('users') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.users.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">All Users</span>
            </div>
        </a>
        <a href="{{ url('users/create') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.users.create') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Create User</span>
            </div>
        </a>


        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Pages</small>
        </li>
        <!-- /END Separator -->
        <a href="{{ url('pages') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.pages.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">All Pages</span>
            </div>
        </a>
        <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.pages.create') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Create Page</span>
            </div>
        </a>


        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Scenes</small>
        </li>
        <!-- /END Separator -->
        <a href="{{ url('scenes') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.scenes.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">All Scenes</span>
            </div>
        </a>
        <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Scene }})" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.scenes.create')  }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Create Scene</span>
            </div>
        </a>


        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <small>Configuration</small>
        </li>
        <!-- /END Separator -->
        <a href="{{ url('themes') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.themes.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Themes</span>
            </div>
        </a>
        <a href="{{ url('genres') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.genres.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Genres</span>
            </div>
        </a>
        <a href="{{ url('formats') }}" class="bg-dark list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <i class="{{ config('website.icons.formats.index') }} fa-fw mr-3"></i>
                <span class="menu-collapsed">Formats</span>
            </div>
        </a>


{{--        <!-- Separator without title -->--}}
{{--        <li class="list-group-item sidebar-separator menu-collapsed"></li>--}}
{{--        <!-- /END Separator -->--}}

{{--        <a href="#" class="bg-dark list-group-item list-group-item-action">--}}
{{--            <div class="d-flex w-100 justify-content-start align-items-center">--}}
{{--                <span class="fa fa-question fa-fw mr-3"></span>--}}
{{--                <span class="menu-collapsed">Help <span class="badge badge-pill badge-primary ml-2">5</span></span>--}}
{{--            </div>--}}
{{--        </a>--}}


        <a href="#top" data-toggle="sidebar-collapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
            <div class="d-flex w-100 justify-content-start align-items-center">
                <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                <span id="collapse-text" class="menu-collapsed">Collapse</span>
            </div>
        </a>

    </ul><!-- List Group END-->
</div><!-- sidebar-container END -->
