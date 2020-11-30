<div data-wta-ui {{ $attributes->merge(['class' => 'form-file text-center d-inline-flex flex-column position-relative']) }} style="background-color:#2b2b31;">
    <i style="position: absolute;top: -0.5em;right: -0.5em;cursor: pointer;font-size: 1.5em;color: #fff;z-index: 2;" data-iu-remove-preview class="fa fa-times-circle button-red d-none"></i>

    <label style="cursor: pointer;color: rgba(255,255,255,0.5);transition: 0.4s ease;" for="{{ $name }}" id="{{ $name }}Label" class="form-label flex-grow-1 position-relative d-flex flex-column justify-content-center align-items-center">


        <img style="max-height:100%;max-width:100%;" class="position-absolute" data-iu-img-preview src="{{ $source }}" alt="{{ $attributes['title'] ?? '' }}" title="{{ $attributes['title'] ?? '' }}">

        <span style="top: -2em;" class="position-relative" data-iu-img-label>
            {{  $label }}
        </span>


        <span class="d-none flex-row">
            <input data-iu-file accept="image/*" type="file" name="{{ $name }}" id="{{ $name }}" aria-describedby="{{ $name }}Label" class="form-file-input">
            <span class="form-file-text">Choose file...</span>
            <span class="form-file-button">Browse</span>
        </span>
    </label>

    @if($helpText)
        <div id="{{ $name }}HelpBlock" class="form-text tw-text-gray-300">
            {{ $helpText ?? '' }}
        </div>
    @endif

    <div class="valid-feedback">{{ $feedback ?? '' }}</div>

    @error($name, $errorBag)
    <div id="validation{{ $name }}Feedback" class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
