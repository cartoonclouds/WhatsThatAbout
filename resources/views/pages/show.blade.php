@extends('layouts.page')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
<div id="content">
    <a class="mb-3 btn btn-primary" href="{{ url('pages') }}">Back</a>

    @can('view', user())
    <a class="mb-3 btn btn-primary" href="{{ user()->url }}">{{ user()->name }} <small>({{ user()->email }})</small></a>
    @endcan

    @can('createOrUpdate', $page)
    <a href="{{ url("pages/create") }}" class="btn btn-dark float-right ml-2">Create</a>
    <a href="{{ url("pages/$page->slug/edit") }}" class="btn btn-dark float-right"><i class="fa fa-edit"></i> Edit</a>
    @endcan

    <h1>{{ $page->title }} <small>(Slug: {{ $page->slug }})</small></h1>

    <label>Release Year</label>
    <p>{{ $page->release_year }}</p>

    <label>Creator</label>
    <p>{{ $page->creator->name }}</p>

    <label>Synopsis</label>
    <p>
        {{ $page->synopsis }}
    </p>

    @can('create', \App\Models\Segment::class)
        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#createSegment">Create Segment</button>
    @endcan

    <hr>

    <h2>Segments:</h2>

    @each('segments.show', $page->segments, 'segment', 'segment.empty')

    <update-or-create :details="updateDetails" :type="updateType"></update-or-create>
</div>
@endsection


@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data() {
                return {
                    updateDetails: {},
                    updateType: {}
                }
            },
        });
    </script>
@endpush
