<div class="modal fade" id="updateOrCreatePageModal" data-backdrop="static" tabindex="-1" aria-labelledby="updateOrCreatePageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateOrCreatePageModalLabel">Update/Create Page</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="container-fluid p-3 border border-2 border-dark" style="background-color:#28282d">

                        <form id="saveForm" novalidate method="post" action="{{ url('pages/updateOrCreate') }}">
                        <div class="row">

                            <div class="col-3">

                                <x-form.image-upload name="cover_image" class="w-100 h-75 mb-4" title="Cover Image" source="" label="Upload cover (270 x 400)" help-text="Enter a title image for the page" :field-errors="$errors->page"></x-form.image-upload>

                                <x-form.image-upload name="hero_image" class="w-100 h-25 mt-4" title="Hero Image" source="" label="Upload hero (350 x 150)" help-text="Enter a hero image for the page" :field-errors="$errors->page"></x-form.image-upload>

                            </div>

                            <div class="col-9">

                                <x-form.input name="title" value="{{ $page->title }}" placeholder="write here" help-text="Enter a title for the page" label="Page Title" :field-errors="$errors->page"></x-form.input>

                                <x-form.input name="release_year" input-mask="9999" placeholder="YYYY" value="{{ $page->release_year }}" help-text="Enter a Release Year for the page" label="Release Year" :field-errors="$errors->page"></x-form.input>

                                <x-form.input name="run_time" input-mask="99:99:99" value="{{ $page->run_time }}" placeholder="write here" help-text="Enter a Run Time for the page" label="Runtime" :field-errors="$errors->page"></x-form.input>

                                <x-form.textarea name="synopsis" rows="10" style="height:10em;" value="{{ $page->run_time }}" placeholder="Write a interesting synopsis here..." help-text="Enter a Synopsis for the page" label="Synopsis" :field-errors="$errors->page"></x-form.textarea>

                            </div>

                        </div>
                        </form>

                    </div>
            </div>
            <div class="modal-footer tw-bg-gray-500 px-4 py-3 px-sm-6">
                <button type="button" class="btn btn-outline-light rounded shadow" data-dismiss="modal">Close</button>
                <button type="button" form="saveForm" class="btn btn-primary rounded shadow">Understood</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function($) {
            'use strict';
            function save() {
                this.submitted = false

                axios.post(this.url, new FormData(this.$el))
                    .then(response => {

                        notify(response.data.message, 'Page Notification', (this.model.exists ? 'info' : 'success'), null, {
                            url: `/${response.data.page.slug}`
                        })

                        this.$emit('close')

                        if (this.model.exists) { // implies an update so reload
                            window.reload();
                        }

                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors
                        this.errorMessage = errors.response.message
                    })
                    .finally(() => {
                        this.submitted = true
                    })
            }

            function url()
            {
                return `/api/pages/updateOrCreate/${this.model.slug || ''}`
            }
        })(jQuery);
    </script>
@endpush

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
