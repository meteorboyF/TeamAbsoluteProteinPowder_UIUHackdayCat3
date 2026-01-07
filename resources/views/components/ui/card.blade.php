@props([
    'title' => null,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm rounded-xl border border-secondary-200']) }}>
    @if ($title)
        <div class="px-4 py-4 sm:px-6 border-b border-secondary-100 bg-secondary-50/50">
            <h3 class="text-base font-semibold leading-6 text-secondary-900 font-display">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-4 py-4 sm:px-6 bg-secondary-50 border-t border-secondary-100">
            {{ $footer }}
        </div>
    @endif
</div>
