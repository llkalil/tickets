@php
    $id=uniqid('select_')
@endphp
<style>
    input:checked ~ .line {
        background-color: rgba(79, 70, 229, 1);
    }
    input:checked ~ .dot {
        transform: translateX(100%);
    }
</style>
<div class="flex items-center mt-2">
    <label for="{{ $id }}" class="flex items-center cursor-pointer">
        <div class="relative">
            <input id="{{ $id }}" {{ $attributes }} type="checkbox" class="sr-only" />
            <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner line transition shadow"></div>
            <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
        </div>
        <div class="ml-3 text-gray-700">
            {{ $slot ?? '' }}
        </div>
    </label>
</div>

@error($attributes->wire('model')->value)
<p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror