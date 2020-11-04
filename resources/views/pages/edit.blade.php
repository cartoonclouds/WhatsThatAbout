@extends('layouts.page')
@section('head')
    @parent
    <style>

    </style>
@stop

@section('content')
    <div id="content">
        <a class="mb-3" href="{{ url('pages') }}">Back</a>

        <form>
            @csrf

            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $page->title }}">

            <br>

            <label for="release_year">Release Year</label>
            <input type="text" name="release_year" id="release_year" value="{{ $page->release_year }}">

            <br>

            <label>Synopsis</label>
            <textarea name="synopsis" id="synopsis">
                {{ $page->synopsis }}
            </textarea>

            <br>

            <button type="button">Save</button>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">

    </script>
@endsection
