@extends('layouts.page')
@section('head')
    @parent
    <style>

    </style>
@stop

@section('content')
    <div id="content">

        <span class="badge badge-danger"><i class="fa fa-exclamation-triangle"></i> DANGER BADGE</span>

        <dl>
        @foreach(\App\Models\Show::all() as $show)
            <dt>
                <a href="{{ $show->url }}">{{ $show->title }}</a>
            </dt>
            <dd>
                <p>{{ $show->synopsis }}</p>
            </dd>
        @endforeach
        </dl>

    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">

    </script>
@endsection
