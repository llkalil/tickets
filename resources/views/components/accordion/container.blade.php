<div class="">
    <div class="shadow">
        <div class="bg-white mx-auto border-gray-200" x-data="{selected:1}">
            <ul class="shadow-box">
                {!! $slot  !!}
            </ul>
        </div>
    </div>
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