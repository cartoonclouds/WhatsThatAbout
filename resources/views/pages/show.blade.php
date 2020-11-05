@extends('layouts.page')
@section('title', 'View Show')
@push('styles')
    <style>
        .vote-icon {
            font-size: 32px;
            color: #878a8c;
            border-radius: 8px;
        }

        .vote-text {
            font-size: 0.75em !important;
        }

        .vote-icon:not(.vote-text):hover {
            background-color: #e0e2e3;
        }

        .vote-icon .selected {
            color: #000;
        }
    </style>
@endpush

@section('content')

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

        <table class="table">
            <tbody>
            @each('segments.show', $page->segments, 'segment', 'segments.empty')
            </tbody>
        </table>
@endsection



@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.up-vote, .down-vote', function (event) {
            $(this).toggleClass('selected');
        })
    </script>
@endpush
