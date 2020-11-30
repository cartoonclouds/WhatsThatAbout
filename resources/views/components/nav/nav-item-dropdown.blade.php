@props(['sub-menu-items', 'tag'])

<li class="c-header-nav-item px-3 dropdown topnav h-100 {{ $tag }} {{ request()->is("$tag*") ? 'c-active show' : '' }}">

    <a id="{{ $tag }}Dropdown" class="c-header-nav-link dropdown-toggle h-100" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded=" {{ request()->is("$tag*") ? 'true' : 'false' }}">
        {{ $slot }}
    </a>

    <div class="dropdown-menu p-0 m-0 {{ request()->is("$tag*") ? 'show' : '' }}" role="menu" aria-labelledby="{{ $tag }}Dropdown">
        <!-- Second nav bar -->
        <div class="c-subheader">

            <div class="c-subheader-nav d-md-down-none mr-2 w-100" style="justify-content: space-evenly;">

                @foreach($subMenuItems as $subMenuItem)
                    <a class="c-subheader-nav-link h-100 w-75 mx-1 justify-content-around text-center {{ request()->is("$tag/{$subMenuItem['name']}*") ? 'active' : '' }}" href="{{ $subMenuItem['url'] }}">
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
