<div class="form-group">

    <div class="form-floating d-block">

        <input {{ $attributes->merge(['class' => $classList, 'type' => 'text']) }}
                {{ $attributes }}
               name="{{ $name }}"
               value="{{ old($name, $value ?? '') }}"
               id="{{ $name }}"
               placeholder="{{ $placeholder }}"
               aria-describedby="{{ $name }}HelpBlock validation{{ $name }}Feedback"
               aria-label="{{ $placeholder }}"
        >

        <label for="{{ $name }}" id={{ $name }}Label" class="form-label mb-0">{{  $label }}</label>

    </div>

    @if($helpText)
        <div id="{{ $name }}HelpBlock" class="form-text text-muted">
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
