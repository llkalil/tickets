<div class="fixed {{$positionCss}} @if($hideOnClick) cursor-pointer @endif"
     x-data="{show: false, timeout: null, duration: null}"
     @if($message)
     x-init="() => { duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) {timeout = setTimeout(() => { show = false }, duration); }}"
     @endif
     @new-toast.window="duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) { timeout = setTimeout(() => { show = false }, duration); }"
     @click="if(@this.hideOnClick) { show = false; }"
     x-show="show"

     @if($transition)
     x-transition:enter="transition ease-in-out duration-300"
     x-transition:enter-start="opacity-0 transform {{$this->transitioClasses['enter_start_class']}}"
     x-transition:enter-end="opacity-100 transform {{$this->transitioClasses['enter_end_class']}}"
     x-transition:leave="transition ease-in-out duration-500"
     x-transition:leave-start="opacity-100 transform {{$this->transitioClasses['leave_start_class']}}"
     x-transition:leave-end="opacity-0 transform {{$this->transitioClasses['leave_end_class']}}"
        @endif
>
    @if($message)

        <div class="bg-{{$bgColorCss}}-100 border-t-4 border-{{$bgColorCss}}-500 rounded-b text-{{$bgColorCss}}-900 px-4 py-3 shadow-md"
             role="alert">
            <div class="flex">
                @if($showIcon)

                    <div class="py-1 flex justify-center items-center">
                        <div class="p-1 rounded-full border-{{$bgColorCss}}-500 border-2 mr-4">
                            <div class="fill-current h-6 w-6 text-{{$bgColorCss}}-500">
                                @include('livewire-toast::icons.' . $type)
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center items-center">
                    <p class="">{{$message}}</p>
                </div>
            </div>
        </div>

    @endif
</div>

