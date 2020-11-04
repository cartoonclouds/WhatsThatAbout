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
        @foreach(\App\Models\Page::all() as $page)
            <dt>
                <a href="{{ $page->url }}">{{ $page->title }}</a> <small>/ <a href="{{ url("pages/$page->slug/edit") }}">Edit</a></small>
            </dt>
            <dd>
                <p>{{ $page->synopsis }}</p>
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
