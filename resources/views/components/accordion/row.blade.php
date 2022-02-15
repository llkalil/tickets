@php
    $id = rand();
@endphp
<li class="relative border-b border-gray-200">
    <button type="button" class="w-full px-5 py-4 text-left"
            @click="selected !== {{ $id }} ? selected = {{ $id }} : selected = null">
        <div class="flex items-center justify-between">
            <span class="flex items-center">{{ $title ?? '' }}</span>
            <span class="text-md ml-2">
                <i :class="{'rotate-180':selected !== {{ $id }}}"
                   class="la la-angle-up transition transform"></i>
            </span>
        </div>
    </button>

    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
         x-bind:style="selected === {{ $id }} ? 'max-height: ' + $el.scrollHeight + 'px' : ''">
        <div class="p-6">
            {!! $slot ??'' !!}
        </div>
    </div>
</li>