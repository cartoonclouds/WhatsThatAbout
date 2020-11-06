@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
<div id="content" class="container-fluid">

    @can('createOrUpdate', $page)
        <button class="btn btn-dark float-right ml-2" @click="$bus.$emit('update-or-create', 'create', {{ new \App\Models\Page }})">Create</button>
        <button class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', 'edit', {{ $page }})"><i class="fa fa-edit"></i> Edit</button>
    @endcan

    <h1 class="hvr-wobble-to-bottom-right">An animated element</h1>

    <h1>{{ $page->title }}</h1>

    <label>Release Year</label>
    <p>{{ $page->release_year }}</p>

    <label>Creator</label>
    <p>{{ $page->creator->name }}</p>

    <label>Synopsis</label>
    <p>
        {{ $page->synopsis }}
    </p>

    @can('create', \App\Models\Segment::class)
        <button type="button" class="btn btn-dark float-right" @click="$bus.$emit('update-or-create', 'create', {{ new \App\Models\Segment }})">Create Segment</button>
    @endcan

    <hr>

    <h2>Segments:</h2>

    @each('segments.partials.segment', $page->segments, 'segment', 'segments.partials.empty')

    <update-or-create></update-or-create>
</div>
@endsection


@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '#app',
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
