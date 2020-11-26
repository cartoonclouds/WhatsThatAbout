
@props(['icon', 'url'])

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ $url }}">
        <i class="c-sidebar-nav-icon {{ $icon }}"></i> {{ $slot }}
    </a>
</li>
