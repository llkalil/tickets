<script>
    const setup = () => {
        function getSidebarStateFromLocalStorage() {
            // if it already there, use it
            if (window.localStorage.getItem('isSidebarOpen')) {
                return JSON.parse(window.localStorage.getItem('isSidebarOpen'))
            }// else return the initial state you want
            return false
        }

        function setSidebarStateToLocalStorage(value) {
            window.localStorage.setItem('isSidebarOpen', value)
        }

        return {
            loading: true, isSidebarOpen: getSidebarStateFromLocalStorage(), toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
                setSidebarStateToLocalStorage(this.isSidebarOpen)
            }, isSettingsPanelOpen: false, isSearchBoxOpen: false,
        }
    }
</script>

<div>
    <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()"
         x-init="$refs.loading.classList.add('hidden')">
        <div x-ref="loading"
             class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
             style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"> Loading.....
        </div>
        <div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
             style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
        <aside x-cloak x-transition:enter="transition transform duration-300"
               x-transition:enter-start="-translate-x-full opacity-30 ease-in"
               x-transition:enter-end="translate-x-0 opacity-100 ease-out"
               x-transition:leave="transition transform duration-300"
               x-transition:leave-start="translate-x-0 opacity-100 ease-out"
               x-transition:leave-end="-translate-x-full opacity-0 ease-in"
               class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-60 max-h-screen overflow-hidden transition-all transform bg-white border-r shadow-lg lg:z-auto lg:static lg:shadow-none"
               :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}">
            <div class="flex items-center justify-between flex-shrink-0 p-2"
                 :class="{'lg:justify-center': !isSidebarOpen}">
                <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
                    T<span x-show="isSidebarOpen">ickets</span>
                </span>
                <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
                    <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                <ul class="p-2 overflow-hidden">
                    <x-sidebar.item>
                        <x-slot name="icon">
                            <i class="la la-home"></i>
                        </x-slot>
                        Home
                    </x-sidebar.item>
                    <x-sidebar.item>
                        <x-slot name="icon">
                            <i class="la la-play"></i>
                        </x-slot>
                        Meus cursos
                    </x-sidebar.item>
                    <x-sidebar.item>
                        <x-slot name="icon">
                            <i class="la la-map-signs"></i>
                        </x-slot>
                        Descobrir
                    </x-sidebar.item>
                    <div x-data="{opened:true}">
                        <h1 class="text-md uppercase ml-2 hover:bg-gray-100 transition flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100 " @click="opened = !opened">
                            Studio
                            <span class="text-md ml-2">
                                <i :class="{'rotate-180':opened}"
                                   class="la la-angle-up transition transform"></i>
                            </span>
                        </h1>
                        <div x-show="opened" class="pl-2"
                             x-transition:enter="transition duration-200 transform ease-out origin-top"
                             x-transition:enter-start="scale-y-0"
                             x-transition:leave="transition duration-100 transform ease-in origin-top"
                             x-transition:leave-end="opacity-0 scale-y-90">
                            <x-sidebar.item route="studio.create">
                                <x-slot name="icon">
                                    <i class="la la-plus-circle"></i>
                                </x-slot>
                                Criar
                            </x-sidebar.item>
                            <x-sidebar.item>
                                <x-slot name="icon">
                                    <i class="la la-play-circle"></i>
                                </x-slot>
                                Meus cursos
                            </x-sidebar.item>
                            @livewire('common.drafts-button')
                            <x-sidebar.item>
                                <x-slot name="icon">
                                    <i class="la la-chart-pie"></i>
                                </x-slot>
                                Status
                            </x-sidebar.item>
                        </div>
                    </div>
                </ul>
            </nav>
            <div class="flex-shrink-0 ">
                <div class="border-t p-2">
                    <form action="{{ route('logout') }}" method="post" x-ref="logout_form">
                        @csrf
                    </form>
                    <button class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring"
                            @click="$refs.logout_form.submit()">
                    <span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </span>
                        <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
                    </button>
                </div>
            </div>
        </aside>
        <div class="flex flex-col flex-1 h-full overflow-hidden">
            <header class="flex-shrink-0 border-b">
                <div class="float-right flex items-center justify-between p-2">
                    <div class="flex items-center space-x-3">
                        <div class="flex justify-center ">
                            <!-- Dropdown -->
                            <!-- // Dropdown -->
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between p-2">
                    <div class="flex items-center space-x-3">
                        <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden">{{ config('app.name') }}</span>
                        <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
                            <svg class="w-4 h-4 text-gray-600"
                                 :class="{'transform transition-transform -rotate-180': isSidebarOpen}"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>
            <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
                @yield('content')
            </main>
        </div>
    </div>
</div>