<div class="form-file form-file mb-3 position-relative">
    <i class="fa fa-times-circle button-red remove-image"></i>

    <label for="{{ $name }}" id="{{ $name }}Label" class="{{ $name }} form-label w-100 h-100 p-4  bg-light text-center d-flex flex-column justify-content-center align-items-center">

{{--        <template v-if="imageSrc">--}}
            <img src="{{ $source }}" title="Cover Image" class="w-100 h-100">
            <small class="d-block mt-3 description">{{ $description }}</small>
{{--        </template>--}}

{{--        <template v-else>--}}
            {{  $label }}
{{--        </template>--}}

        <input accept="image/*" type="file" name="{{ $name }}" id="{{ $name }}" aria-describedby="{{ $name }}Label" class="d-none form-file-input">
        <span class="form-file-text d-none">Choose file...</span>
        <span class="form-file-button d-none">Browse</span>

    </label>

    @if($helpText)
        <div id="{{ $name }}HelpBlock" class="form-text">
            {{ $helpText ?? '' }}
        </div>
    @endif

    <div class="valid-feedback">{{ $feedback ?? '' }}</div>

    @error($name, 'page')
    <div id="validation{{ $name }}Feedback" class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@push('scripts')
    <script>
        (function($) {
            'use strict';
            const $imageUpload = $('#{{ $name }}Label');
            const $fileInput = $imageUpload.find('input[type="file"]');
            const $fileReader = new FileReader();
            let image

            if (typeof ($fileReader) != "undefined") {

                $fileReader.addEventListener('load', (event) => {
                    $imageUpload.find('img').attr('src', $fileReader.result);
                })

                $fileInput.on('change', (event) => {
                    if ($fileInput.files && $fileInput.files[0]) {
                        $fileReader.readAsDataURL($fileInput.files[0])
                    }
                });

            } else {
                alert("This browser does not support HTML5 FileReader.")
            }
        })(jQuery);
    </script>
@endpush

@push('styles')
    <style>
        img:hover {
            cursor: pointer;
        }

        .description {
            color: #657eae;
        }

        .remove-image {
            position: absolute;
            top: -0.5em;
            right: -0.5em;
            font-size: 1.5em;
            color: orangered;
            z-index: 2;
        }
    </style>
@endpush
