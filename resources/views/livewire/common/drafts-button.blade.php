<div>
    <x-sidebar.item class="relative" route="studio.drafts">
        <x-slot name="icon">
            @if($drafts_count > 0)
                <div class="absolute right-1">
                    <span class="absolute rounded-full shadow-sm bg-red-600 text-sm text-white p-1 "></span>
                    <span class="absolute rounded-full shadow-sm bg-red-600 text-sm text-white p-1 animate-ping"></span>
                </div>
            @endif
            <i class="las la-archive"></i>
        </x-slot>
        Rascunhos
        @if($drafts_count > 0)
            <span class="rounded-md shadow-sm bg-red-600 text-xs text-white p-1">{{ $drafts_count > 99?"99+":$drafts_count }}</span>
        @endif
    </x-sidebar.item>
</div>
