<div>
    <x-accordion.container>
        @forelse($steps as $step)
            <x-accordion.row>
                <x-slot name="title">
                    <span class="text-xl relative text-gray-400 pr-1 mr-1 transition">
                        <i class="la {{ constant('\App\Models\CourseStep::ICON_TYPE_'.strtoupper($step->type)) }}"></i>
                    </span>
                    <div class="flex items-baseline text-sm">
                        {{ $step->title }} <span
                                class="text-gray-500 text-sm ml-2 inline-block whitespace-nowrap overflow-hidden"
                                x-init="setText($el)">{{ strip_tags($step->subtitle) }}</span>
                    </div>
                </x-slot>

            </x-accordion.row>
        @empty
            <div class="w-full px-5 py-4 text-left relative border-b border-gray-200">
                As etapas do curso aparecerão aqui.
            </div>
        @endforelse
    </x-accordion.container>
    <script>

        function setText(el) {
            el.setAttribute("data-text", el.innerText);
            checkForChanges()

            function checkForChanges() {
                let width = el.getBoundingClientRect().width,
                    str = el.getAttribute("data-text"),
                    widths = [],
                    chars = [];
                for (let i = 0; i < str.length; i++) {
                    let char = str.charAt(i)
                    let lspan = document.createElement('span');

                    document.body.appendChild(lspan);
                    lspan.innerText = char;
                    let lwidth = lspan.getBoundingClientRect().width
                    widths.push(lwidth)
                    document.body.removeChild(lspan);
                    chars.push(char)
                    if (widths.reduce((partialSum, a) => partialSum + a, 0) > width - 14) {
                        i = 9999999999999999999999999;
                    }
                }
                if(widths.reduce((partialSum, a) => partialSum + a, 0) < width ){
                    el.innerText = chars.join('')
                }else {
                    el.innerText = chars.join('') + '...';
                }
            }

            window.addEventListener('resize', checkForChanges)
        }
    </script>
</div>
