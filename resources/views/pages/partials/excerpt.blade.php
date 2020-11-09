<div class="col">
    <div class="card h-100 rounded hvr-float hvr-glow">
        <img src="{{ $page->thumbnail }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><a href="{{ $page->url }}">{{ $page->title }}</a></h5>
            <div class="card-text">

                <div style="max-height:20rem;overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
                    <label>Release Year</label>
                    <div>{{ $page->release_year }}</div>

                    <label>Creator</label>
                    <div>{{ $page->creator->name }}</div>

                    <label>Synopsis</label>
                    <div>{{ $page->synopsis }}</div>
                </div>

                <a href="{{ $page->url }}" class="stretched-link">View</a>
            </div>
        </div>
        <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
        </div>
    </div>
</div>
