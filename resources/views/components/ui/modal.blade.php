@props([
    'name',
    'title' => null,
    'maxWidth' => '2xl'
])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div
    x-data="{ show: false }"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="relative z-50"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    style="display: none;"
>
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-secondary-900/80 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full {{ $maxWidth }}"
                 @click.away="show = false"
            >
                @if($title)
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-secondary-100">
                        <h3 class="text-lg font-semibold leading-6 text-secondary-900 font-display" id="modal-title">
                            {{ $title }}
                        </h3>
                    </div>
                @endif
                
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                    {{ $slot }}
                </div>

                @if(isset($footer))
                    <div class="bg-secondary-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
