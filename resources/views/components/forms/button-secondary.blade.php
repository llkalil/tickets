<button
        {{ $attributes->merge(['class' => "border-2 inline-block border-indigo-600 text-indigo-600 shadow transition hover:bg-indigo-600 hover:text-white text-white py-2 px-5 rounded"]) }}>
    {{ $slot ?? '' }}
</button>