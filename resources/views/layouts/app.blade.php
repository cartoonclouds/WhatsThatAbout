<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- FavIcons -->
    <link rel="shortcut icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">
    <link rel="icon" href="{{ config('website.favicon-url') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script>
        window.csrf_token = '{{ csrf_token() }}';
        window.remember_token = '{{ user()->getRememberToken() }}';
    </script>
    <style>
        body {
            font-family: 'Roboto';
        }

        #body-row {
            margin-left:0;
            margin-right:0;
        }

        #sidebar-container {
            min-height: 100vh;
            background-color: #333;
            padding: 0;
        }

        /* Sidebar sizes when expanded and expanded */
        .sidebar-expanded {
            width: 230px;
        }
        .sidebar-collapsed {
            width: 60px;
        }

        /* Menu item*/
        /*#sidebar-container li + .list-group-item,*/
        /*#sidebar-container .list-group-item:first-of-type {*/
        /*    padding-top: 1em;*/
        /*    padding-bottom: 1em;*/
        /*}*/

        #sidebar-container .list-group a {
            height: 50px;
            color: white;
        }

        /* Submenu item*/
        #sidebar-container .list-group .sidebar-submenu a {
            height: 45px;
            padding-left: 30px;
        }
        .sidebar-submenu {
            font-size: 0.9rem;
        }

        /* Separators */
        .sidebar-separator-title {
            background-color: #333;
            height: 35px;
        }
        .sidebar-separator {
            background-color: #333;
            height: 25px;
        }
        .logo-separator {
            background-color: #333;
            height: 60px;
        }

        /* Closed submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
            content: " \f0d7";
            font-family: "Font Awesome 5 Pro";
            display: inline;
            text-align: right;
            padding-left: 10px;
            font-weight: bold;
        }
        /* Opened submenu icon */
        #sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
            content: " \f0da";
            font-family: "Font Awesome 5 Pro";
            display: inline;
            text-align: right;
            padding-left: 10px;
            font-weight: bold;
        }
    </style>


    @stack('styles')
</head>
<body class="vh-100">
    <div id="app" class="h-100">
        @php($page = App\Models\Page::with(['coverImage', 'heroImage'])->find(1))

        <form id="saveForm" novalidate method="post" action="{{ url('pages/updateOrCreate') }}">
            <div class="container p-3 border border-2 border-dark" style="background-color:#28282d">

                <div class="row">

                    <div class="col-3">

                        <x-form.image-upload name="cover_image" class="w-100 h-75 mb-4" title="Cover Image" source="{{ $page->coverImage->file_path }}" label="Upload cover (270 x 400)" help-text="Enter a title image for the page" :field-errors="$errors->page"></x-form.image-upload>

                        <x-form.image-upload name="hero_image" class="w-100 h-25 mt-4" title="Hero Image" source="{{ $page->heroImage->file_path }}" label="Upload hero (350 x 150)" help-text="Enter a hero image for the page" :field-errors="$errors->page"></x-form.image-upload>

                    </div>

                    <div class="col-9">

                        <x-form.input name="title" value="{{ $page->title }}" placeholder="write here" help-text="Enter a title for the page" label="Page Title" :field-errors="$errors->page"></x-form.input>

                        <x-form.input name="release_year" input-mask="9999" placeholder="YYYY" value="{{ $page->release_year }}" help-text="Enter a Release Year for the page" label="Release Year" :field-errors="$errors->page"></x-form.input>

                        <x-form.input name="run_time" input-mask="99:99:99" value="{{ $page->run_time }}" placeholder="write here" help-text="Enter a Run Time for the page" label="Runtime" :field-errors="$errors->page"></x-form.input>

                        <x-form.textarea name="synopsis" rows="10" style="height:10em;" value="{{ $page->run_time }}" placeholder="Write a interesting synopsis here..." help-text="Enter a Synopsis for the page" label="Synopsis" :field-errors="$errors->page"></x-form.textarea>

                    </div>

                </div>

            </div>
        </form>

{{--        <header>--}}
{{--            @include('layouts.navigation.topnav')--}}

{{--            @include('layouts.header')--}}
{{--        </header>--}}

{{--        <main class="main row" id="body-row">--}}

{{--            @hasanyrole($allRoles->implode('|'))--}}
{{--                @include('layouts.navigation.sidenav')--}}
{{--            @endhasanyrole--}}


{{--            <!-- MAIN -->--}}
{{--            <div class="col row p-4 mx-0">--}}

{{--                <aside class="col-lg-2">--}}
{{--                    @include('layouts.search')--}}
{{--                </aside>--}}

{{--                <div class="col">--}}
{{--                    @include('flash::message')--}}

{{--                    @hasanyrole($adminRoles->implode('|'))--}}
{{--                    <div class="alert alert-info mb-3">--}}
{{--                        <i class="fa fa-exclamation"></i> Hey! You're a {{ user()->roles->first()->pretty_name }}, why not <a href="#" @click="$bus.$emit('update-or-create', {{ new \App\Models\Page }})">create a new page</a>?--}}
{{--                    </div>--}}
{{--                    @endhasanyrole--}}

{{--                    @yield('content')--}}

{{--                </div>--}}

{{--            </div><!-- Main Col END -->--}}


{{--            @auth--}}
{{--            </div><!-- body-row END -->--}}
{{--            @endauth--}}

{{--        </main>--}}

{{--        @include('layouts.footer')--}}

    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        // will be an export
        const ImageUpload = (function($) {
            'use strict';

            // data-iu-img-preview      Image tag to display the preview
            // data-iu-img-label        Label to show if no image preview
            // data-iu-remove-preview   Button to remove the image preview
            // data-iu-file             File input which uploads the image

            const ImageUpload = function (uuid) {
                'use strict';

                // Attach some elements
                this.uuid = uuid;
                this.imageUpload = document.getElementById(`image-upload${uuid}`);

                if (this.imageUpload.dataset.imageUploadInstance) {
                    return;
                }

                this.imageUpload.dataset.imageUploadInstance = this;

                this.imagePreview = this.imageUpload.querySelector('[data-iu-img-preview]');
                this.imageLabel = this.imageUpload.querySelector('[data-iu-img-label]');
                this.imageRemovePreview = this.imageUpload.querySelector('[data-iu-remove-preview]');
                this.inputFile = this.imageUpload.querySelector('[data-iu-file]');

                // Attach listeners
                this._attachListeners();

                // Create FileReader
                this.instantiateFileRead();

                // Update the UI
                this.renderChanges();
            };

            ImageUpload.prototype = {

                constructor: ImageUpload,

                _attachListeners()
                {
                    this.imageRemovePreview.addEventListener('click', (evt) => this.removePreview());
                },


                renderChanges()
                {
                    let hideElements = [];
                    let showElements = [];

                    if (this.isEmpty(this.imagePreview.getAttribute('src'))) {
                        hideElements.push(this.imageRemovePreview);
                        showElements.push(this.imageLabel);
                    } else {
                        hideElements.push(this.imageLabel);
                        showElements.push(this.imageRemovePreview);
                    }

                    hideElements.forEach((el) => this.hide(el));
                    showElements.forEach((el) => this.show(el));
                },

                show(el)
                {
                    el.classList.add('d-block');
                    el.classList.remove('d-none');
                },

                hide(el)
                {
                    el.classList.add('d-none');
                    el.classList.remove('d-block');
                },

                removePreview()
                {
                    this.imagePreview.setAttribute('src', '');
                    this.renderChanges();
                },

                isEmpty(val)
                {
                    return !val || parseFloat(val || 0) === 0.00 || String(val).length === 0;
                },


                instantiateFileRead()
                {
                    const reader = new FileReader();

                    if (typeof (reader) != "undefined") {
                        this.reader = new FileReader();

                        this.reader.addEventListener('load', (evt) => {
                            this.imagePreview.setAttribute('src', this.reader.result);

                            this.renderChanges();
                        });

                        this.inputFile.addEventListener('change', async (evt) => {
                            const fileInput = evt.target;

                            if (fileInput.files && fileInput.files[0]) {
                                await this.reader.readAsDataURL(fileInput.files[0])

                                this.renderChanges();
                            }
                        });
                    } else {
                        alert("This browser does not support HTML5 FileReader.")
                    }
                }


            }


            return ImageUpload;
        })(jQuery);
    </script>
    <script>
        $(document).ready(function() {

            // Hide submenus
            $('#body-row .collapse').collapse('hide');

            // Collapse/Expand icon
            $('#collapse-icon').addClass('fa-angle-double-left');

            // Collapse click
            $('[data-toggle=sidebar-collapse]').click(function() {
                SidebarCollapse();
            });

            function SidebarCollapse (e) {
                $('.menu-collapsed').toggleClass('d-none');
                $('.sidebar-submenu').toggleClass('d-none');
                $('.submenu-icon').toggleClass('d-none');
                $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

                // Treating d-flex/d-none on separators with title
                var SeparatorTitle = $('.sidebar-separator-title');

                if ( SeparatorTitle.hasClass('d-flex') ) {
                    SeparatorTitle.removeClass('d-flex');
                } else {
                    SeparatorTitle.addClass('d-flex');
                }

                // Collapse/Expand icon
                $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
            }

            /**
             * Setup Inputmask
             */
            Inputmask().mask(document.querySelectorAll('input'));

            $('#flash-overlay-modal').modal();

            $('.select2').select2();

            // Enable all tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            window.User = @json([
                'user' => Auth::user(),
                'signedIn' => Auth::check()
            ]);
        });
    </script>

    @stack('scripts')
</body>
</html>
