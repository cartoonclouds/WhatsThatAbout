@extends('layouts.app')
@section('title', 'View Format')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">

        <a href="{{ back()->getTargetUrl() }}" class="btn btn-dark float-left"><i class="fa fa-chevron-double-left"></i> Back</a>

        <h2>{{ $format->name }}</h2>

    </div>

@endsection


@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
