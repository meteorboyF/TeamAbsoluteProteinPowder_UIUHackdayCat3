@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'position' => 'left'
])

@php
    $baseClass = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500 shadow-sm',
        'secondary' => 'bg-white text-secondary-700 border border-secondary-300 hover:bg-secondary-50 focus:ring-primary-500 shadow-sm',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 shadow-sm',
        'ghost' => 'text-secondary-600 hover:bg-secondary-100 hover:text-secondary-900 focus:ring-secondary-500',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];

    $classes = $baseClass . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && $position === 'left')
        <x-dynamic-component :component="$icon" class="mr-2 -ml-1 h-4 w-4" />
    @endif

    {{ $slot }}

    @if($icon && $position === 'right')
        <x-dynamic-component :component="$icon" class="ml-2 -mr-1 h-4 w-4" />
    @endif
</button>
