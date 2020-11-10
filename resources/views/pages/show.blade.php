@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">

        <a href="{{ back()->getTargetUrl() }}" class="btn btn-dark float-left"><i class="fa fa-chevron-double-left"></i> Back</a>

        @can('createOrUpdate', $page)
            <button class="btn btn-dark float-right ml-2" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">Create</button>
            <button class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', {{ $page }})"><i class="fa fa-edit"></i> Edit</button>
        @endcan

        <div class="clearfix"></div>

        <article>

            <h2 class="hvr-wobble-to-bottom-right">
                {{ $page->title }}
            </h2>

            <div class="card">

                <div class="card-body">

                    <div class="card-text">

                        <div class="row">

                            <div class="col-4 text-center">
                                <img src="{{ $page->cover_image }}" class="card-img-top border-radius-0 page-cover" alt="..." style="width:100%;max-width: 270px;">
                            </div>

                            <div class="col-8">

                                <p>Release Year: {{ $page->release_year }}</p>

                                <p>Runtime: {{ $page->runtime }}</p>

                                <p>Creator: {{ $page->creator->name }}</p>


                            </div>

                        </div>

                        <p class="my-4">
                            {{ $page->synopsis }}
                        </p>

                        @can('create', \App\Models\Segment::class)
                            <button type="button" class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', {{ new \App\Models\Segment }})">Create Segment</button>
                        @endcan

                    </div>
                </div>
            </div>

        </article>



        <hr>

        <h2>Segments:</h2>

        @each('segments.partials.segment', $page->segments, 'segment', 'segments.partials.empty')
    </div>

    <update-or-create></update-or-create>
@endsection


@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '.app',
            components: {
                segment: Segment
            },
            data() {
                return {
                    //
                }
            },
            mounted()
            {

            }
        });
    </script>
@endpush
