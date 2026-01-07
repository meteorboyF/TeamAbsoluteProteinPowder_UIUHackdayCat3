@props([
    'disabled' => false,
    'label' => null,
    'id' => null,
    'name' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'error' => null
])

@php
    $id = $id ?? $name ?? Str::random(8);
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-secondary-900 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative mt-2">
        <select {{ $disabled ? 'disabled' : '' }}
                id="{{ $id }}"
                name="{{ $name }}"
                {{ $attributes->merge([
                    'class' => 'block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-secondary-900 ring-1 ring-inset ring-secondary-300 focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6 disabled:cursor-not-allowed disabled:bg-secondary-50 disabled:text-secondary-500'
                ]) }}
        >
            @if($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif
            
            @foreach($options as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
            
            {{ $slot }}
        </select>
    </div>

    @if($error)
        <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $error }}</p>
    @error($name) 
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @endif
</div>
