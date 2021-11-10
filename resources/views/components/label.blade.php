@props(['value'])

<label {{ $attributes->merge(['class' => 'block ml-3 font-semibold text-sm text-gray-700 tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
