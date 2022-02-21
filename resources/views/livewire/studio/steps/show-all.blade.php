<div>
    <x-accordion.container>
        @forelse($steps as $step)
            <x-accordion.row>
                <x-slot name="title">
                    <span class="text-xl relative text-gray-400 pr-1 mr-1 transition duration-150">
                        <i class="la {{ constant('\App\Models\CourseStep::ICON_TYPE_'.strtoupper($step->type)) }}"></i>
                    </span>
                    <div class="flex items-baseline text-sm">
                        {{ $step->title }} <span
                                class="text-gray-500 text-sm ml-2 inline-block whitespace-nowrap overflow-hidden"
                                x-init="setText($el)">{{ strip_tags($step->subtitle) }}</span>
                    </div>
                </x-slot>
                <div class="">
                    <h1 class="text-xl my-2">
                        {{ $step->title }}
                    </h1>
                    <h1 class="text-lg my-2">
                        {!!  $step->subtitle  !!}
                    </h1>
                    @switch($step->type)
                        @case(\App\Models\CourseStep::TYPE_ARTICLE)
                        {!! $step->contents !!}
                        @break

                        @case(\App\Models\CourseStep::TYPE_ACTIVITY)
                        @forelse($step->alternatives as $alternative)
                            <div class="p-2 border-t border-b border-gray-200 flex">
                                <span class="w-1/2">{{ $alternative->content }}</span>
                                <span class="flex gap-2 justify-end w-1/2">
                            @if ($alternative->is_active)
                                        <i class="la la-eye text-gray-600"></i>
                                    @else
                                        <i class="la la-eye-slash text-gray-600"></i>
                                    @endif
                                    @if ($alternative->is_correct)
                                        <i class="la la-check text-green-600"></i>
                                    @else
                                        <i class="la la-times text-red-600"></i>
                                    @endif
                        </span>
                            </div>
                        @empty
                            <div class="text-center p-4">
                                Ops, não encontramos perguntas para esta atividade
                            </div>
                        @endforelse
                        @break

                        @case(\App\Models\CourseStep::TYPE_VIDEO)


                        @if ($step->video->converted_at !== null && is_array($step->video->conversions))
                            <video
                                    x-init="videojs($el.id)"
                                    id="{{ \Illuminate\Support\Str::random() }}"
                                    class="video-js w-full aspect-video my-2"
                                    controls
                                    preload="auto"
                                    data-setup='{}'>

                                @foreach($step->video->conversions as $conversion)
                                    <source src="{{ url(\Illuminate\Support\Facades\Storage::disk('converted_videos')->url('/'.$conversion) )  }}"
                                            type="video/{{ \Illuminate\Support\Str::after($conversion,'.') }}">
                                @endforeach
                                <p class="vjs-no-js">
                                    Para visualizar este video ative o JavaScript e considere migrar para um browser que
                                    <a href="https://videojs.com/html5-video-support/" target="_blank">
                                        suporta videos HTML5
                                    </a>
                                </p>
                            </video>
                        @else
                            <div class="w-full aspect-video flex items-center justify-center align-middle bg-gray-100 shadow h-48 p-4">
                                <h1>Aguarde a conversão do video para poder visualiza-lo</h1>

                            </div>

                        @endif
                        @break

                    @endswitch
                </div>
            </x-accordion.row>
        @empty
            <div class="w-full px-5 py-4 text-left relative border-b border-gray-200">
                As etapas do curso aparecerão aqui.
            </div>
        @endforelse
    </x-accordion.container>
</div>
