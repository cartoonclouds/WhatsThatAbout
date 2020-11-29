
<div class="post-excerpt col-md-6 col-lg-4 col-xxl-3 p-2 row no-gutters h-100">

    <div class="col-4">

        <a href="{{ $page->url }}" class="bd-placeholder-img">
            <i class="fa fa-step-forward" style="position: absolute;font-size: 4em;color: white;"></i>
            {!! placeholder($page->genre->name, 'Poster Placeholder') !!}
        </a>

    </div>

    <div class="col card m-0 d-flex justify-content-between flex-column">

        <h5 class="card-header p-0 pb-2 text-truncate">
            <a href="{{ $page->url }}" class="text-decoration-none">{{ $page->title }}</a>
        </h5>

        <div class="card-body p-0 pt-2">

            <p class="card-subtitle small">{{ $page->format->name }} by {{ $page->creator->name }}</p>

            <div class="card-text mt-2">
                <div class="badge badge-secondary">{{ $page->genre->name }}</div>
                <div class="badge badge-secondary">{{ $page->runtime }}</div>
                <div class="badge badge-secondary">{{ $page->release_year }}</div>
            </div>


            <div class="text-justify mt-2 text-break text-truncate-200">
                {{ $page->synopsis }}
            </div>

        </div>

        @hasanyrole($allRoles->implode('|'))
        <div class="card-footer text-muted p-0 mt-3">
            <small>Last updated {{ $page->updated_at->diffForHumans() }}, by ??</small>
        </div>
        @endhasanyrole

    </div>

</div>
