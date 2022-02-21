<button
        @if ($attributes->thatStartWith('wire:click')->first() !== null)
        wire:loading.attr="disabled"
        wire:loading.class="opacity-75 cursor-default"
        wire:target="{{ \Illuminate\Support\Str::before($attributes->thatStartWith('wire:click')->first(),"(") }}"
        @endif
        {{ $attributes->merge(['class' => "primary group gap-2 flex justify-center items-center align-content-center bg-indigo-600 shadow inline-block hover:bg-white text-white hover:text-indigo-600 border-2 border-transparent hover:border-indigo-600 transition py-2 px-4 rounded"]) }}>

    @if ($attributes->thatStartWith('wire:click')->first() !== null)
        <span wire:loading.delay
              wire:target="{{ \Illuminate\Support\Str::before($attributes->thatStartWith('wire:click')->first(),"(") }}"
              class="flex justify-center items-center align-content-center"
        >
            <svg class="motion-reduce:hidden  animate-spin h-5 w-5 text-white group-hover:text-indigo-600"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
    </span>
    @endif
    {{ $slot ?? '' }}
</button>