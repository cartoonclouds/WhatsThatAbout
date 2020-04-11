<header class="bmd-layout-header">
    <div class="navbar navbar-light bg-white">
        <span class="navbar-brand navbar-brand mb-0 h1">
            <button class="navbar-toggler" type="button" data-toggle="drawer" data-target="#dw-s1"
                    aria-expanded="true" aria-controls="w-s1" aria-label="Toggle drawer">
                <span class="sr-only">Toggle drawer</span>
                {{ config('app.name') }} <span class="navbar-toggler-icon"></span>
            </button>
        </span>
        <div class="navbar-nav mr-auto flex-row">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Features</a>
            <a class="nav-item nav-link" href="#">Pricing</a>
            <a class="nav-item nav-link disabled" href="#">Disabled</a>
        </div>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <!-- Authentication Links -->
        <span class="divider"></span>
        @guest
            <a class="nav-item nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
                <a class="nav-item nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @else
            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->username }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>
</header>
