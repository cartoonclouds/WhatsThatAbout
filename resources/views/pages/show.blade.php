@extends('layouts.page')
@section('head')
    @parent
    <style>

    </style>
@stop

@section('content')
    <div id="content">
        <a class="mb-3" href="{{ url('pages') }}">Back</a>

        <h1>{{ $page->title }} <small>(Slug: {{ $page->slug }})</small></h1>

        <label>Release Year</label>
        <p>{{ $page->release_year }}</p>

        <label>Creator</label>
        <p>{{ $page->creator->name }}</p>

        <label>Synopsis</label>
        <p>
            {{ $page->synopsis }}
        </p>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">

    </script>
@endsection
