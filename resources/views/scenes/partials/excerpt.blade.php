<div class="card mb-3">
    <div class="row no-gutters">

        <div class="col-md-4">
            <svg class="bd-placeholder-img" width="100%" height="100%"  role="img"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                {!! placeholder('Scene', 'Poster Placeholder') !!}
            </svg>
        </div>

        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $scene->title }}
                </h5>

                <p class="card-text" style="max-height:10rem;overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
                    {{ $scene->details }}
                </p>

                <a href="{{ $scene->url }}" class="mb-3 mr-4 card-text d-block text-right text-decoration-none">Continue <i class="fa fa-chevron-double-right"></i></a>
            </div>

            @hasanyrole($allRoles->implode('|'))
            <div class="card-footer text-muted">
                <small>Last updated {{ $scene->updated_at->diffForHumans() }}, by ??</small>
            </div>
            @endhasanyrole
        </div>
    </div>
</div>
