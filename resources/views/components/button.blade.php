@props([
    'primaryColor' => 'indigo',
    'secondaryColor' => 'blue',
])

<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => "inline-flex justify-center py-1.5 px-3 rounded-full text-base text-white tracking-wider
                    bg-gradient-to-r from-$primaryColor-500 to-$secondaryColor-500
                    hover:from-$primaryColor-600 hover:to-$secondaryColor-600",
    ]) }}>
    {{ $slot }}
</button>
