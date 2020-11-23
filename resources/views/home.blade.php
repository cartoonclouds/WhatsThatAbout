@extends('layouts.app')

@section('content')
<div id="content" class="container-fluid">

    @include('layouts.navigation.sorting')

    <div class="grid grid-cols-3 gap-5">
        @each('pages.partials.excerpt', $pages, 'page')
    </div>

    {{ $pages->withQueryString()->links() }}

{{--    @can('createOrUpdate', 'page')--}}
{{--        <update-or-create></update-or-create>--}}
{{--    @endcan--}}
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '#app',
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
