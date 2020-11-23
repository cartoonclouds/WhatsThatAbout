@extends('layouts.app')
@section('title', 'View Show')
@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div id="content" class="container-fluid h-100">

        <div class="d-flex align-items-start h-100">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist" aria-orientation="vertical">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active p-3" id="details-pill" data-toggle="pill" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link p-3" id="settings-pill" data-toggle="pill" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link p-3" id="contact-pill" data-toggle="pill" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-pill">
                    user details, name, email etc.
                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-pill">
                    display settings
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-pill">
                    how often should be contacted
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
