@props([
    'color' => 'blue',
    'hover' => 'gray'
])

<a {{ $attributes->merge(['class'=> "text-sm text-$color-600 hover:text-$hover-700 cursor-pointer"]) }}>
    {{$slot}}
</a>
