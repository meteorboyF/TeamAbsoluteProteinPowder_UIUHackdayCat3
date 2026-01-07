@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'checked' => false,
    'disabled' => false
])

@php
    $id = $id ?? $name ?? Str::random(8);
@endphp

<div class="flex items-center" x-data="{ on: {{ $checked ? 'true' : 'false' }} }">
    <button type="button" 
            role="switch" 
            aria-checked="false" 
            :aria-checked="on.toString()" 
            @click="on = !on" 
            {{ $disabled ? 'disabled' : '' }}
            :class="on ? 'bg-primary-600' : 'bg-secondary-200'" 
            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
        
        <span class="sr-only">Use setting</span>
        
        <span aria-hidden="true" 
              :class="on ? 'translate-x-5' : 'translate-x-0'" 
              class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
        </span>
        
        <input type="hidden" name="{{ $name }}" :value="on ? 1 : 0">
    </button>
    
    @if($label)
        <span class="ml-3 text-sm" id="{{ $id }}-label">
            <span class="font-medium text-secondary-900">{{ $label }}</span>
        </span>
    @endif
</div>
