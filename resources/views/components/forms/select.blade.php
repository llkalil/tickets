@props([
    'label' => ''
])
@php
    $id=uniqid('select_')
@endphp
<label class="block mt-2 text-sm font-medium text-gray-700 leading-5" for="{{$id}}">
    {{ $label ?? '' }}
</label>

<div class="mt-1 rounded-md shadow-sm">
    <select {{ $attributes }} id="{{$id}}"
            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400
           focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm
            sm:leading-5 @error($attributes->wire('model')->value) border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror">
        {{ $slot ?? '' }}
    </select>

</div>
@error($attributes->wire('model')->value)
<p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror