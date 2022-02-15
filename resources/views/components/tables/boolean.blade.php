<div class="flex justify-center align-center items-center">
    @isset($value)
        @if ($value)
            <div class="rounded-full text-lg p-1 bg-green-200 shadow flex h-7 w-7 justify-center align-center items-center">
                <i class="la la-check text-green-700"></i>
            </div>

        @else
            <div class="rounded-full text-lg p-1 bg-red-200 shadow flex h-7 w-7 justify-center align-center items-center">
                <i class="la la-times text-red-700"></i>
            </div>
        @endif
    @else
        <div class="rounded-full text-lg p-1 bg-yellow-200 shadow flex h-7 w-7 justify-center align-center items-center">
            <i class="la la-exclamation-triangle text-yellow-700"></i>
        </div>
    @endisset
</div>