@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">

        @include('scenes.partials.scene')

        <update-or-create></update-or-create>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
