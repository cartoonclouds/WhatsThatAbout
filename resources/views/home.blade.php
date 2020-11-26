@extends('layouts.app')
@section('content')

    @include('layouts.navigation.sorting')

    @foreach($pages->chunk(3) as $rowPage)
        <div class="card-deck mb-2" style="height: 237px;">
            @each('pages.partials.excerpt', $rowPage, 'page')
        </div>
    @endforeach


    {{ $pages->withQueryString()->links() }}

@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
