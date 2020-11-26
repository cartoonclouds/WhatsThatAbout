
<div class="card mx-3 rounded">
    <div class="row h-100">

        <div class="col-md-4">

{{--            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" role="img">--}}
{{--                <title>Placeholder</title>--}}
{{--                <rect width="100%" height="100%" fill="#868e96"/>--}}
{{--                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>--}}
{{--            </svg>--}}
            <img src="/" class="w-100 h-100">

        </div>

        <div class="col-md-8 d-flex justify-content-between flex-column">

            <div class="card-body p-0">
                <h5 class="card-title m-0 mb-2 text-truncate">
                    <a href="{{ $page->url }}" class="text-decoration-none">{{ $page->title }}</a>
                </h5>

                <p class="card-subtitle small">{{ $page->format->name }} by {{ $page->creator->name }}</p>

                <div class="card-text mt-2">
                    <div class="badge badge-secondary">{{ $page->genre->name }}</div>
                    <div class="badge badge-secondary">{{ $page->runtime }}</div>
                    <div class="badge badge-secondary">{{ $page->release_year }}</div>
                </div>


                <div class="text-justify mt-2 text-break" style="max-height:5rem;overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
                    {{ $page->synopsis }}
                </div>


                <a href="{{ $page->url }}">Continue <i class="fa fa-chevron-double-right"></i></a>
            </div>

            @hasanyrole($allRoles->implode('|'))
            <div class="card-footer text-muted p-0">
                <small>Last updated {{ $page->updated_at->diffForHumans() }}, by ??</small>
            </div>
            @endhasanyrole

        </div>

    </div>
</div>


