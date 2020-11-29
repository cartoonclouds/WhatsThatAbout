@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">

        @canany(['create', 'edit'], $scene)
            <a href="{{ url('admin/scenes/create') }}" class="btn btn-dark float-right ml-2">Create</a>
            <a href="{{ url("admin/scenes/$scene->slug/edit") }}" class="btn btn-dark float-right ml-2"><i class="fa fa-edit"></i> Edit</a>

            <div class="clearfix"></div>
        @endcan

        <article>

            <h1>{{ $scene->title }}</h1>


        </article>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
