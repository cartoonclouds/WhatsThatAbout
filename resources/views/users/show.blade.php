@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">
        <h1>User is <strong>{{ $user->name }}</strong></h1>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
