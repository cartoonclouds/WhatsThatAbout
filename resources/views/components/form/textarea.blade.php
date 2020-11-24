<div class="form-group">

    <div class="form-floating d-block">

        <textarea {{ $attributes->merge(['class' => $classList, 'type' => 'text', 'autocomplete' => 'off']) }}
               name="{{ $name }}"
               id="{{ $name }}"
               placeholder="{{ $placeholder }}"
               data-inputmask="{{ "'mask':'$inputMask'" }}"
               aria-describedby="{{ $name }}HelpBlock validation{{ $name }}Feedback"
               aria-label="{{ $placeholder }}"
        >
            {{ old($name, $value ?? '') }}
        </textarea>

        <label for="{{ $name }}" id={{ $name }}Label'"  class="form-label">{{  $label }}</label>

    </div>

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
