@extends('layouts.app')
@section('content')

    @hasanyrole($adminRoles->implode('|'))
    <div class="alert alert-info mb-3">
        <i class="fa fa-exclamation"></i> Hey! You're a {{ user()->roles->first()->pretty_name }}, why not <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">create a new page</a>?
    </div>
    @endhasanyrole

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
