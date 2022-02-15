@props([
'active' => false,
'route' => false
])
@php
    if ($route) {
        $active = request()->routeIs($route);
    }
@endphp

<li>
    <a {{ $attributes->merge(['href'=>($route)?route($route):'#','class' => ($active?'bg-gray-100':'').' group flex items-center p-2 mb-1 space-x-2 rounded-md hover:bg-gray-100 transition']) }}
       :class="{'justify-center': !isSidebarOpen}">
                            <span class="text-2xl relative text-gray-400 group-hover:text-black transition">
                                {{ $icon ?? '' }}
                            </span>
        <span :class="{'lg:hidden': !isSidebarOpen}">{{ $slot ?? '' }}</span>
    </a>
</li>