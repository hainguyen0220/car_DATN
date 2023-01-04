<div class="{{ $parentClass ?? 'mb-3 row' }}">
    <label for="{{ $label }}" class="{{ $labelClass ?? 'col-sm-2 col-form-label' }}">{{ __('title.' . ($label ?? ($name ?? ''))) }}</label>
    <div class="{{ $inputClass ?? 'col-sm-3 btn-group' }}" style="left: 100px;">
        @foreach ($options as $option)
            <input type="checkbox" class="btn-check" name="{{ $name }}[]" value="{{ $option }}" id="{{ $option }}" {{ in_array($option, $checked) ? 'checked':'' }}>
            <label class=" m-3  btn btn-info btn-sm border rounded shadow-lg " for="{{ $option }}" >{{ $transform ? $transform[$option] : $option }}</label>
        @endforeach

    </div>
</div>