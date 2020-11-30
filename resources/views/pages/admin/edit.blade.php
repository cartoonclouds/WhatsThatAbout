@extends('layouts.app')
@section('title', 'Page Editing')
@push('styles')
    <style>
        .cover_image, .hero_image {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            margin: 0;
            transition: 0.4s ease;
        }

        .cover_image {
            height: 400px;
        }

        .hero_image {
            height: 150px;
        }

        .cover_image:hover, .hero_image:hover {
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid">
        <h5>Update/Create Page</h5>

        <form id="saveForm" class="needs-validation" novalidate method="post" action="{{ url('admin/pages/store/' . ($page->exists ? $page->slug : '')) }}">
            <div class="row">

                <div class="col-3">

                    <x-form.image-upload name="cover_image" class="w-100 h-75" error-bag="page" title="Cover Image" source="" label="Upload cover (270 x 400)" help-text="Enter a title image for the page" :field-errors="$errors->page"></x-form.image-upload>

                    <x-form.image-upload name="hero_image" class="w-100 h-25 mt-2" error-bag="page" title="Hero Image" source="" label="Upload hero (350 x 150)" help-text="Enter a hero image for the page" :field-errors="$errors->page"></x-form.image-upload>

                </div>

                <div class="col-9">

                    <x-form.input name="title" value="{{ $page->title }}" error-bag="page" placeholder="write here" help-text="Enter a title for the page" label="Page Title" :field-errors="$errors->page"></x-form.input>

                    <x-form.input name="release_year" class="input-year" error-bag="page" placeholder="YYYY" value="{{ $page->release_year }}" help-text="Enter a Release Year for the page" label="Release Year" :field-errors="$errors->page"></x-form.input>

                    <x-form.input name="run_time" class="input-runtime" error-bag="page" value="{{ $page->run_time }}" placeholder="" help-text="Enter a Run Time for the page" label="Runtime" :field-errors="$errors->page"></x-form.input>

                    <x-form.textarea name="synopsis" rows="10" style="height:10em;" error-bag="page" value="{{ $page->run_time }}" placeholder="Write a interesting synopsis here..." help-text="Enter a Synopsis for the page" label="Synopsis" :field-errors="$errors->page"></x-form.textarea>

                </div>

            </div>

            <div class="row">

                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary rounded shadow">{{ $page->exists ? 'Update' : 'Create' }} Page</button>
                </div>

            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script>
        // Runtime ##h ##m ##s
        new Cleave('.input-runtime', {
            time: true,
            timePattern: ['h', 'm', 's']
        });

        // Date
        // new Cleave('.input-date', {
        //     date: true,
        //     datePattern: ['Y', 'm', 'd'],
        // });

        // Year
        new Cleave('.input-year', {
            date: true,
            datePattern: ['Y'],
        });
    </script>
@endpush
