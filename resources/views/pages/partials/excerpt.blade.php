
<div class="post-excerpt col-4 px-2 rounded">
    <div class="card">
        <div class="row no-gutters">

            <div class="col-md-4 pfe-md-3">

                <a href="{{ $page->url }}" class="bd-placeholder-img">
                    <i class="fa fa-step-forward" style="position: absolute;font-size: 4em;color: white;"></i>

                    <svg width="100%" height="100%"  role="img"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                        <rect width="100%" height="100%" fill="#868e96"/>
                        <text pointer-events="none" style="user-select: none" x="50%" y="50%" fill="#dee2e6" text-anchor="middle">
                            <tspan x="50%" y="50%">{{ $page->genre->name }} Poster</tspan>
                            <tspan x="50%" y="60%">Placeholder</tspan>
                        </text>
                        <title>{{ $page->genre->name }} Poster Placeholder</title>
                    </svg>
                </a>

            </div>

            <div class="col-md-8 pl-0 d-flex justify-content-between flex-column">

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


                    <div class="text-justify mt-2 text-break" style="overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
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


    </div>
</div>


