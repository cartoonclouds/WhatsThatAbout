
<div class="card mb-3">
    <div class="row g-0">

        <div class="col-md-3">
            <img src="{{ Storage::url($scene->coverImage->file_path) }}" class="flex-shrink-0 mr-3" alt="Scene Cover Image">
        </div>

        <div class="col-md-9">
            <div class="card-body">
                <h5 class="card-title">{{ $scene->title }}</h5>

                <p class="card-text" style="max-height:10rem;overflow: hidden;text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;">
                    {{ $scene->details }}
                </p>

                <a href="{{ $scene->url }}" class="mb-3 mr-4 card-text d-block text-right text-decoration-none">Continue <i class="fa fa-chevron-double-right"></i></a>

                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>

    </div>
</div>
