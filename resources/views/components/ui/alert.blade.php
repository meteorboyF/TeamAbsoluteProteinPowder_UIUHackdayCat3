@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $typeClasses = [
        'info' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
        'success' => 'bg-green-50 text-green-700 ring-green-600/20',
        'warning' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
        'error' => 'bg-red-50 text-red-700 ring-red-600/10',
    ];

    $iconClasses = [
        'info' => 'text-blue-700',
        'success' => 'text-green-600',
        'warning' => 'text-yellow-800',
        'error' => 'text-red-600',
    ];

    $icons = [
        'info' => '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />',
        'success' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />',
        'warning' => '<path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />',
        'error' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />',
    ];
@endphp

<div x-data="{ show: true }" 
     x-show="show" 
     class="rounded-md p-4 ring-1 ring-inset {{ $typeClasses[$type] ?? $typeClasses['info'] }} mb-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $iconClasses[$type] ?? $iconClasses['info'] }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                {!! $icons[$type] ?? $icons['info'] !!}
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
                <h3 class="text-sm font-medium {{ $iconClasses[$type] ?? $iconClasses['info'] }}">{{ $title }}</h3>
            @endif
            <div class="text-sm text-secondary-700 {{ $title ? 'mt-2' : '' }}">
                {{ $slot }}
            </div>
        </div>
        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" @click="show = false" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $typeClasses[$type] }}">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
