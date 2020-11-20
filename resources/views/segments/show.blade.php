@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">

        @include('segments.partials.segment')

        <update-or-create></update-or-create>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            components: {
                segment: Segment
            },
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
