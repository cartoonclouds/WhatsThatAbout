@extends('layouts.app')
@section('content')

    @include('layouts.navigation.sorting')


    <div class="row">
        @each('pages.partials.excerpt', $pages, 'page')
    </div>


    {{ $pages->withQueryString()->links() }}

@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
