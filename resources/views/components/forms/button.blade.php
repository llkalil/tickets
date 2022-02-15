<button
        {{ $attributes->merge(['class' => "primary bg-indigo-600 shadow inline-block hover:bg-white text-white hover:text-indigo-600 border-2 border-transparent hover:border-indigo-600 transition py-2 px-5 rounded"]) }}>
    {{ $slot ?? '' }}
</button>