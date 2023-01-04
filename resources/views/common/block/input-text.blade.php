<div class="{{ $parentClass ?? 'mb-3 row' }}">
    <label for="{{ $name }}"
        class="{{ $labelClass ?? 'col col-form-label' }}">{{ __('title.' . ($label ?? ($name ?? ''))) }}</label>
    <div class="{{ $inputClass ?? 'col' }} col-cusluon">
        <input type="{{ $type ?? 'text' }}" class="form-control " id="{{ $name }}" name="{{ $name }}"
            value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" {{ ($readonly ?? false) ? 'readonly' : '' }}
            min="{{ $min ?? '' }}" max="{{ $max ?? '' }}">
        @error($name)
            <div class="mt-3">
                <span class="alert-danger mt-2">{{ $errors->first($name) }}</span>
            </div>
        @enderror
    </div>

</div>
