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
            <button class="btn btn-dark float-right ml-2" @click="$bus.$emit('update-or-create', {{ (new \App\Models\Page) }})">Create</button>
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

                            @if($page->coverImage)
                                <div class="col-4 text-center">
                                    <img src="{{ Storage::url($page->coverImage->file_path) }}" class="card-img-top border-radius-0 page-cover" alt="..." style="width:100%;max-width: 270px;">
                                </div>
                            @endif

                            <div class="{{$page->coverImage ? 'col-8' : 'col-12'}}">

                                <p>Release Year: {{ $page->release_year }}</p>

                                <p>Runtime: {{ $page->runtime }}</p>

                                <p>Creator: {{ $page->creator->name }}</p>


                            </div>

                        </div>

                        <p class="my-4">
                            {{ $page->synopsis }}
                        </p>

                        @can('create', \App\Models\Scene::class)
                            <button type="button" class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', {{ new \App\Models\Scene }})">Create Scene</button>
                        @endcan

                    </div>
                </div>
            </div>

        </article>



        <hr>

        <h2>Scene:</h2>

        <div class="row row-cols-1">
            @each('scenes.partials.excerpt', $page->scenes, 'scene', 'scenes.partials.empty')
        </div>
    </div>

    <x-update-or-create-page :page="$page"></x-update-or-create-page>
@endsection


@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            components: {
                //
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
