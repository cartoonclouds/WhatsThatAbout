@php /** @var \Yajra\DataTables\Html\Builder $dataTable */ @endphp
@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">
        <h3 class="mb-4"><i class="{{ config('website.icons.users.index') }}"></i> All Users</h3>
        {!! $dataTable->table() !!}
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>

    </script>
@endpush
