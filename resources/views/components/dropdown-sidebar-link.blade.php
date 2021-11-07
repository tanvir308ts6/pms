@props([
    'color' => 'indigo',
])

<a role="menuitem"
    {{ $attributes->merge(['class' => "block p-2 text-sm text-$color-400 transition-colors duration-200 hover:text-$color-700"]) }}>
    {{ $slot }}
</a>
