@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid p-0">
        <h3 class="mb-4"><i class="{{ config('website.icons.themes.index') }}"></i> All Themes</h3>
        {!! $dataTable->table() !!}
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>

    </script>
@endpush
