<div>
    <div class="p-2 w-full">
        <button class="flex items-center p-2 w-full font-medium tracking-wider uppercase space-x-2 rounded-md transition hover:bg-gray-100 rounded-md focus:outline-none focus:ring"
                :class="{'justify-center': !isSidebarOpen}"
                @click="Livewire.emit('openModal', 'modals.settings')"
        >
                    <span class="flex relative">
                        @if ($badgeCount >= 1)
                            <div class="absolute right-1">
                                <span class="absolute rounded-full shadow-sm bg-red-600 text-sm text-white p-1 "></span>
                            <span class="absolute rounded-full shadow-sm bg-red-600 text-sm text-white p-1 animate-ping"></span>
                            </div>
                        @endif
                        <i class="la la-cog text-3xl "></i>
                    </span>
            <span :class="{'lg:hidden': !isSidebarOpen}"> Configurações </span>
        </button>
    </div>
</div>
