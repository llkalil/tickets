@php
    $id = uniqid('asd_')
@endphp
<div x-data="" x-init="tippy($refs.button, {
        content: $refs.template.innerHTML,
        trigger: 'click',
        placement: 'left',
        theme: 'light',
        interactive: true,
        allowHTML: true
    });">
    <button x-ref="button"
            class="focus:ring-2 p-1 flex justify-center align-middle items-center rounded-md focus:outline-none"
            role="button" aria-label="option" {{--@click="isOpen = !isOpen"--}}>
        <i class="las la-ellipsis-h text-xl"></i>
    </button>
    <div x-ref="template" style="display: none" class="w-32 bg-white rounded border shadow-lg py-2">
        @foreach($buttons as $button)
            <a href="#" @click="isOpen=false"
               class="block w-32 block {{ $loop->first?'':'border-t ' }} transition leading-tight hover:bg-gray-200">{!! $button !!}</a>
        @endforeach
    </div>
</div>