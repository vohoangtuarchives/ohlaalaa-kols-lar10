@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-3 form-label']) }}>
    {{ $value ?? $slot }}
</label>
