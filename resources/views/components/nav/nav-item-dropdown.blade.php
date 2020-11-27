
@props(['link' => '#', 'sub-menu-items'])

<li class="c-header-nav-item px-3 dropdown has-megamenu h-100">

    <a class="c-header-nav-link dropdown-toggle h-100" href="{{ $link }}" data-toggle="dropdown">
        {{ $slot }}
    </a>

    <div class="dropdown-menu p-0 m-0 megamenu">
        <!-- Second nav bar -->
        <div class="c-subheader">

            <div class="c-subheader-nav d-md-down-none mr-2 w-100" style="justify-content: space-evenly;">

                @foreach($subMenuItems as $subMenuItem)
                    <a class="c-subheader-nav-link h-100 w-75 justify-content-around text-center" href="{{ $subMenuItem['url'] }}">
                        {{ $subMenuItem['name'] }}
                    </a>
                    @if(!$loop->last)
                        <span class="text-white-50">|</span>
                    @endif
                @endforeach

            </div>

        </div>
    </div> <!-- dropdown-mega-menu.// -->

</li>
