@props([
    'disabled' => false,
    'label' => null,
    'id' => null,
    'name' => null,
    'error' => null
])

@php
    $id = $id ?? $name ?? Str::random(8);
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-secondary-900 dark:text-white/90 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative rounded-md shadow-sm">
        <input {{ $disabled ? 'disabled' : '' }} 
               id="{{ $id }}"
               name="{{ $name }}"
               {{ $attributes->merge([
                   'class' => 'block w-full rounded-md border-0 py-1.5 text-secondary-900 dark:text-white shadow-sm ring-1 ring-inset ring-secondary-300 dark:ring-white/10 placeholder:text-secondary-400 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 disabled:cursor-not-allowed disabled:bg-secondary-50 disabled:text-secondary-500 disabled:ring-secondary-200 bg-white dark:bg-white/5'
               ]) }}
        >
    </div>

    @if($error)
        <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $error }}</p>
    @error($name) 
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @endif
</div>
