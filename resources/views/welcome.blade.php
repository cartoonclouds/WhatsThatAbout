@extends('layouts.app')

@section('content')
    <div id="content" class="container-fluid">
        <div class=" justify-content-center">


                {{ __('You are logged in!') }}

                <div class="row row-cols-1 row-cols-md-3 g-4">

                    @each('pages.partials.excerpt', \App\Models\Page::limit(10)->get(), 'page')
                </div>


        </div>
    </div>
@endsection
