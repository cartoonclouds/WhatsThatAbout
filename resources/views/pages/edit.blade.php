@extends('layouts.page')
@section('head')
    @parent
    <style>

    </style>
@stop

@section('content')
    <div id="content">
        <a class="mb-3" href="{{ url('pages') }}">Back</a>

        <h1>Auth: {{ request()->user()->name }}</h1>

        <form class="editPageForm">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $page->title ?? '' }}">

            <br>

            <label for="release_year">Release Year</label>
            <input type="text" name="release_year" id="release_year" value="{{ $page->release_year ?? '' }}">

            <br>

            <label for="runtime">Runtime</label>
            <input type="time" name="runtime" id="runtime" value="{{ $page->runtime ?? '' }}">

            <br>

            <label for="thumbnail">Thumbnail (base64)</label>
            <input type="text" name="thumbnail" id="thumbnail" value="{{ $page->thumbnail ?? '' }}">

            <br>

            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis">
                {{ $page->synopsis ?? '' }}
            </textarea>

            <br>

            <button type="submit" class="btn btn-info">Save</button>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).on('submit', '.editPageForm', function(event) {
            event.preventDefault();
            const $form = $(this);

            axios.post('{{ url('api/pages/updateOrCreate/' . ($page->slug ?? '')) }}', $form.serialize())
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error(error);
                })
        });
    </script>
@endsection
