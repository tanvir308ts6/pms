@props([
    'isActive' => (bool) false,
    'color' => 'indigo',
    'title' => 'Sidebar option'
])

<div x-data="{ isActive: {{ $isActive ? 'true' : 'false' }}, open: {{ $isActive ? 'true' : 'false' }}}">
    <a @click="$event.preventDefault(); open = !open"
        {{ $attributes->merge(['class' => "flex items-center p-2 text-gray-500 transition-colors rounded-md hover:bg-$color-100"]) }}
        :class="{'bg-{{ $color }}-100': isActive || open}" 
        role="button" 
        aria-haspopup="true"
        :aria-expanded="(open || isActive) ? 'true' : 'false'">
        <span aria-hidden="true">
            {{ $icon }}
        </span>
        <span class="ml-2 text-sm">{{ __("$title") }}</span>
        <span class="ml-auto" 
            aria-hidden="true">
            <div class="transition-transform transform" 
                :class="{ 'rotate-180': open }">
                <x-icons.chevron-down />
            </div>
        </span>
    </a>
    <div role="menu" 
        x-show="open" 
        class="mt-2 space-y-2 px-7" 
        aria-label="Dashboards">
       {{ $options }}
    </div>
</div>
