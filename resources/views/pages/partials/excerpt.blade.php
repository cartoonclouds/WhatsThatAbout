<article class="col">
    <div class="card h-100 rounded hvr-float hvr-glow">

        <img src="{{ Storage::url($page->heroImage->file_path) }}" class="card-img-top" alt="..." style="height:150px;">

        <div class="card-body">

            <h3 class="card-title page-title">
                <a href="{{ $page->url }}" class="text-decoration-none">{{ $page->title }}</a>
            </h3>

            <div class="card-text">

                <div class="tags mb-3">
                    <span class="badge bg-primary">{{ $page->release_year }}</span>
                </div>

                <div class="row">
                    <div class="col">Release Year: </div>
                    <div class="col">{{ $page->release_year }}</div>
                </div>

                <div class="row">
                    <div class="col">Runtime: </div>
                    <div class="col">{{ $page->runtime }}</div>
                </div>

                <div class="row">
                    <div class="col">Creator: </div>
                    <div class="col">{{ $page->creator->name }}</div>
                </div>

                <hr>

                <div style="max-height:10rem;overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
                    {{ $page->synopsis }}
                </div>


            </div>

        </div>

        <a href="{{ $page->url }}" class="mb-3 mr-4 text-right text-decoration-none">Continue <i class="fa fa-chevron-double-right"></i></a>

        @hasanyrole($allRoles->implode('|'))
        <div class="card-footer">
            <small class="text-muted">Last updated {{ $page->updated_at->diffForHumans() }}, by ??</small>
        </div>
        @endhasanyrole
    </div>
</article>
