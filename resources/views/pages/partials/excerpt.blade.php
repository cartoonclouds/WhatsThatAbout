<article class="max-w-md m-3 bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl hvr-float hvr-glo">
    <div class="md:flex flex-col">
        <div class="md:flex-shrink-0">
            <img class="h-48 w-full object-cover w-100" src="{{ Storage::url($page->heroImage->file_path) }}" alt="Man looking at item at a store">
        </div>
        <div class="p-8">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $page->title }}</div>
            <a href="{{ $page->url }}" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Finding customers for your new business</a>
            <div class="mt-2 text-gray-500">

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

                <a href="{{ $page->url }}" class="mb-3 mr-4 text-right text-decoration-none">Continue <i class="fa fa-chevron-double-right"></i></a>
            </div>
        </div>
    </div>
</article>


{{--    @hasanyrole($allRoles->implode('|'))--}}
{{--    <div class="card-footer">--}}
{{--        <small class="text-muted">Last updated {{ $page->updated_at->diffForHumans() }}, by ??</small>--}}
{{--    </div>--}}
{{--    @endhasanyrole--}}

