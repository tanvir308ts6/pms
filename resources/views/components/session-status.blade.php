@props([
    'status'
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-100 rounded-md p-3 border-l-4 border-r-4 border-green-600
                                            font-medium text-sm text-green-700']) }}>
        {{ $status }}
    </div>
@endif
