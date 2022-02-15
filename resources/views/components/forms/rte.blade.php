@php
    $id = uniqid('editor_')
@endphp
<label for="#{{ $id }}" class="block text-sm font-medium text-gray-700 mt-2 leading-5">
    {{ $slot ?? '' }}
</label>

<div class="mt- rounded-md shadow-sm" x-init="initiateQuill{{ $id }}('{{ $id }}')" wire:ignore>
    <div {{ $attributes->merge(['class'=>'appearance-none block w-full px-3 py-2 border border-gray-300 rounded-b-md
                               placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300
                               transition duration-150 ease-in-out sm:text-sm sm:leading-5 ' . ($errors->has($attributes->wire('model')->value)?'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red':'')]) }} id="{{ $id }}"
    ></div>
</div>

<script>

    function initiateQuill{{ $id }}(id) {
        let quill{{ $id }} = new Quill('#' + id, {
            modules: {
                toolbar: true
            },
            theme: 'snow'
        });
        function debounce{{ $id }}(func, timeout = 500){
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
            };
        }
        function saveInput{{ $id }}(){
            @this.{{ $attributes->wire('model')->value }} = quill{{ $id }}.root.innerHTML;
        }
        quill{{ $id }}.on('text-change', debounce{{ $id }}(() => saveInput{{ $id }}()));
    }
</script>

@error($attributes->wire('model')->value)
<p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror