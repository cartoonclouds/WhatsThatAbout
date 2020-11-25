@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>
        .dataTable {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
<div id="content" class="container-fluid">
    <h3 class="mb-4"><i class="{{ config('website.icons.scenes.index') }}"></i> All Scenes</h3>
    {!! $dataTable->table() !!}
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
    </script>
@endpush
