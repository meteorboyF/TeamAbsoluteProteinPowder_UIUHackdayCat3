@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'checked' => false,
    'disabled' => false,
    'description' => null
])

@php
    $id = $id ?? $name ?? Str::random(8);
@endphp

<div class="relative flex items-start">
    <div class="flex h-6 items-center">
        <input id="{{ $id }}" 
               aria-describedby="{{ $id }}-description" 
               name="{{ $name }}" 
               type="checkbox" 
               {{ $checked ? 'checked' : '' }}
               {{ $disabled ? 'disabled' : '' }}
               {{ $attributes->merge(['class' => 'h-4 w-4 rounded border-secondary-300 text-primary-600 focus:ring-primary-600 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    </div>
    <div class="ml-3 text-sm leading-6">
        @if($label)
            <label for="{{ $id }}" class="font-medium text-secondary-900 {{ $disabled ? 'opacity-50' : '' }}">{{ $label }}</label>
        @endif
        
        @if($description)
            <p id="{{ $id }}-description" class="text-secondary-500 {{ $disabled ? 'opacity-50' : '' }}">{{ $description }}</p>
        @endif
    </div>
</div>
