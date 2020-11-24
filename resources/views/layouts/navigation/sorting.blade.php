<nav class="navbar navbar-expand navbar-light mb-2">
    <div class="container-fluid justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">Popular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ request()->fullUrlWithQuery(['sort' => 'date_low']) }}">Date (low)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ request()->fullUrlWithQuery(['sort' => 'date_high']) }}">Date (high)</a>
            </li>
        </ul>
    </div>
</nav>
