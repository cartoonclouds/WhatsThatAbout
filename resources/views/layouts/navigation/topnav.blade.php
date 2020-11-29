
    @hasanyrole($adminRoles->implode('|'))
        <button class="c-header-toggler c-class-toggler d-lg-none ml-3" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <i class="c-header-toggler-icon"></i>
        </button>

        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <i class="c-header-toggler-icon"></i>
        </button>
    @endhasanyrole


    <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="full"></use>
        </svg>`
    </a>


    <ul class="c-header-nav d-md-down-none">
{{--        <li class="c-header-nav-item px-3 h-100">--}}
{{--            <a class="c-header-nav-link active" href="{{ url('/') }}">--}}
{{--                <i class="{{ config('website.icons.home') }}"></i>&nbsp;Home--}}
{{--            </a>--}}
{{--        </li>--}}

        <x-nav.nav-item-dropdown :sub-menu-items="$genres" tag="genre">
            <i class="{{ config('website.icons.genres.index') }} mr-2"></i>Genres
        </x-nav.nav-item-dropdown>

        <x-nav.nav-item-dropdown :sub-menu-items="$themes" tag="theme">
            <i class="{{ config('website.icons.themes.index') }} mr-2"></i>Themes
        </x-nav.nav-item-dropdown>

        <x-nav.nav-item-dropdown :sub-menu-items="$formats" tag="format">
            <i class="{{ config('website.icons.formats.index') }} mr-2"></i>Formats
        </x-nav.nav-item-dropdown>


{{--        <li class="c-header-nav-item px-3 dropdown show has-megamenu h-100">--}}

{{--            <a class="c-header-nav-link dropdown-toggle h-100" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">--}}
{{--                Test--}}
{{--            </a>--}}

{{--            <div role="menu" class="dropdown-menu show p-0 m-0 megamenu">--}}
{{--                <!-- Second nav bar -->--}}
{{--                <div class="c-subheader">--}}

{{--                    <div class="c-subheader-nav d-md-down-none mr-2 w-100" style="justify-content: space-evenly;">--}}

{{--                            <a class="c-subheader-nav-link h-100 w-75 justify-content-around text-center" href="/">--}}
{{--                                name--}}
{{--                            </a>--}}
{{--                            <span class="text-white-50">|</span>--}}
{{--                            <a class="c-subheader-nav-link h-100 w-75 justify-content-around text-center" href="/">--}}
{{--                                name2--}}
{{--                            </a>--}}
{{--                            <span class="text-white-50">|</span>--}}
{{--                            <a class="c-subheader-nav-link h-100 w-75 justify-content-around text-center" href="/">--}}
{{--                                name3--}}
{{--                            </a>--}}
{{--                            <span class="text-white-50">|</span>--}}


{{--                    </div>--}}

{{--                </div>--}}
{{--            </div> <!-- dropdown-mega-menu.// -->--}}

{{--        </li>--}}
    </ul>

    <ul class="c-header-nav ml-auto">

        @guest
            <li class="c-header-nav-item px-3 c-d-legacy-none">
                <a class="c-header-nav-link" href="{{ route('login') }}" role="button">
                    <i class="fas fa-sign-in-alt"></i>&nbsp; Login
                </a>
            </li>

            <li class="c-header-nav-item px-3 c-d-legacy-none">
                <a class="c-header-nav-link" href="{{ route('register') }}" role="button">
                    Register
                </a>
            </li>

        @else
{{--            <li class="c-header-nav-item dropdown d-md-down-none mx-2">--}}

{{--            Icon with a badge--}}
{{--            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                <svg class="c-icon">--}}
{{--                    <use xlink:href="cil-bell"></use>--}}
{{--                </svg><span class="badge badge-pill badge-danger">5</span>--}}
{{--            </a>--}}

{{--            Icon with dropdown menu--}}
{{--            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">--}}
{{--                <div class="dropdown-header bg-light">--}}
{{--                    <strong>You have 5 notifications</strong>--}}
{{--                </div>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <svg class="c-icon mr-2 text-success">--}}
{{--                            <use xlink:href="cil-user-follow"></use>--}}
{{--                        </svg> New user registered--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <svg class="c-icon mr-2 text-danger">--}}
{{--                            <use xlink:href="cil-user-unfollow"></use>--}}
{{--                        </svg> User deleted--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <svg class="c-icon mr-2 text-info">--}}
{{--                            <use xlink:href="cil-chart"></use>--}}
{{--                        </svg> Sales report is ready--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <svg class="c-icon mr-2 text-success">--}}
{{--                            <use xlink:href="cil-basket"></use>--}}
{{--                        </svg> New client--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <svg class="c-icon mr-2 text-warning">--}}
{{--                            <use xlink:href="cil-speedometer"></use>--}}
{{--                        </svg> Server overloaded--}}
{{--                    </a>--}}

{{--                <div class="dropdown-header bg-light">--}}
{{--                    <strong>Server</strong>--}}
{{--                </div>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="text-uppercase mb-1">--}}
{{--                            <small><b>CPU Usage</b></small>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                        <small class="text-muted">348 Processes. 1/4 Cores.</small>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="text-uppercase mb-1">--}}
{{--                            <small><b>Memory Usage</b></small>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                        <small class="text-muted">11444GB/16384MB</small>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="text-uppercase mb-1">--}}
{{--                            <small><b>SSD 1 Usage</b></small>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                        <small class="text-muted">243GB/256GB</small>--}}
{{--                    </a>--}}

{{--            </div>--}}
{{--        </li>--}}

{{--        Icon with dropdown menu, link on bottom--}}
{{--        <li class="c-header-nav-item dropdown d-md-down-none mx-2">--}}
{{--            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                <svg class="c-icon">--}}
{{--                    <use xlink:href="cil-list-rich"></use>--}}
{{--                </svg>--}}
{{--                <span class="badge badge-pill badge-warning">15</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">--}}
{{--                <div class="dropdown-header bg-light">--}}
{{--                    <strong>You have 5 pending tasks</strong>--}}
{{--                </div>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="small mb-1">Upgrade NPM &amp; Bower--}}
{{--                            <span class="float-right"><strong>0%</strong></span>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="small mb-1">ReactJS Version--}}
{{--                            <span class="float-right"><strong>25%</strong></span>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="small mb-1">VueJS Version--}}
{{--                            <span class="float-right"><strong>50%</strong></span>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="small mb-1">--}}
{{--                            Add new layouts<span class="float-right"><strong>75%</strong></span>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    <a class="dropdown-item d-block" href="#">--}}
{{--                        <div class="small mb-1">--}}
{{--                            Angular 8 Version<span class="float-right"><strong>100%</strong>--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                        <span class="progress progress-xs">--}}
{{--                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </span>--}}
{{--                    </a>--}}

{{--                <a class="dropdown-item text-center border-top" href="#">--}}
{{--                    <strong>View all tasks</strong>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </li>--}}

{{--        Mail--}}
{{--        <li class="c-header-nav-item dropdown d-md-down-none mx-2">--}}
{{--            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--                <svg class="c-icon">--}}
{{--                    <use xlink:href="cil-envelope-open"></use>--}}
{{--                </svg><span class="badge badge-pill badge-info">7</span></a>--}}
{{--            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">--}}
{{--                <div class="dropdown-header bg-light"><strong>You have 4 messages</strong></div><a class="dropdown-item" href="#">--}}
{{--                    <div class="message">--}}
{{--                        <div class="py-3 mr-3 float-left">--}}
{{--                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>--}}
{{--                        </div>--}}
{{--                        <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">Just now</small></div>--}}
{{--                        <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important message</div>--}}
{{--                        <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>--}}
{{--                    </div>--}}
{{--                </a><a class="dropdown-item" href="#">--}}
{{--                    <div class="message">--}}
{{--                        <div class="py-3 mr-3 float-left">--}}
{{--                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com"><span class="c-avatar-status bg-warning"></span></div>--}}
{{--                        </div>--}}
{{--                        <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">5 minutes ago</small></div>--}}
{{--                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>--}}
{{--                        <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>--}}
{{--                    </div>--}}
{{--                </a><a class="dropdown-item" href="#">--}}
{{--                    <div class="message">--}}
{{--                        <div class="py-3 mr-3 float-left">--}}
{{--                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/5.jpg" alt="user@email.com"><span class="c-avatar-status bg-danger"></span></div>--}}
{{--                        </div>--}}
{{--                        <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">1:52 PM</small></div>--}}
{{--                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>--}}
{{--                        <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>--}}
{{--                    </div>--}}
{{--                </a><a class="dropdown-item" href="#">--}}
{{--                    <div class="message">--}}
{{--                        <div class="py-3 mr-3 float-left">--}}
{{--                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/4.jpg" alt="user@email.com"><span class="c-avatar-status bg-info"></span></div>--}}
{{--                        </div>--}}
{{--                        <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">4:03 PM</small></div>--}}
{{--                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>--}}
{{--                        <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>--}}
{{--                    </div>--}}
{{--                </a><a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>--}}
{{--            </div>--}}
{{--        </li>--}}


        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com"></div>
            </a>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-bell"></use>
                        </svg> Updates<span class="badge badge-info ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-envelope-open"></use>
                        </svg> Messages<span class="badge badge-success ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-task"></use>
                        </svg> Tasks<span class="badge badge-danger ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-comment-square"></use>
                        </svg> Comments<span class="badge badge-warning ml-auto">42</span>
                    </a>

                <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                    <a class="dropdown-item" href="{{ user()->url }}">
                        <i class="fas fa-user fa-fw"></i>&nbsp; Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-cog"></i>&nbsp; Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-credit-card"></use>
                        </svg> Payments<span class="badge badge-secondary ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="cil-file"></use>
                        </svg> Projects<span class="badge badge-primary ml-auto">42</span>
                    </a>

                <div class="dropdown-divider"></div>


                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>&nbsp; Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>

        <button class="c-header-toggler c-class-toggler mr-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="cil-applications-settings"></use>
            </svg>
        </button>

        @endguest

    </ul>

{{--    <div class="c-subheader jumbotron mb-0" style="display: initial;background-color: #d8dbe0;padding: 2rem 1rem;">--}}
{{--        <h1 class="display-4">Hello, world!</h1>--}}
{{--        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>--}}
{{--        <hr class="my-4">--}}
{{--        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>--}}
{{--        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>--}}
{{--    </div>--}}


