@extends('layouts.app')

@section('content')
    <div id="content" class="container-fluid">

        @hasanyrole($adminRoles->implode('|'))
        <div class="alert alert-info mb-3">
            <i class="fa fa-exclamation"></i> Hey! You're a {{ user()->roles->first()->pretty_name }}, why not <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">create a new page</a>?
        </div>
        @endhasanyrole

        @include('layouts.navigation.sorting')

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @each('pages.partials.excerpt', $pages, 'page')
        </div>

        {{ $pages->withQueryString()->links() }}
    </div>

    <update-or-create></update-or-create>
@endsection

@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '.app',
            data() {
                return {
                    //
                }
            },
            mounted()
            {

            }
        });
    </script>
@endpush
