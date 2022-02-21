<div class="my-1 border border-gray-200 shadow-sm p-4 rounded-md" x-data="{ type: @entangle('type') }">
    @if ($video_processing_job_status)
        <div class="absolute fade-in bottom-2 z-40 left-2 bg-gray-50 p-4 pl-2 rounded shadow-lg flex items-center align-middle"
             wire:poll="getVideoProcessingJobStatus('{{ $video_processing_job_status_id }}')">
            <div class="w-1/6 p-2 flex justify-center items-center align-middle">
                <i class="la la-clock text-4xl text-gray-400"></i>
            </div>
            <div class="w-5/6 pl-3 border-l">
                <h1 class="text-md">
                    Seu video está sendo processado...
                </h1>
                <div class="flex justify-between mb-1">
                    <span class="text-base font-medium text-blue-700">Progresso:</span>
                    <span class="text-sm font-medium text-blue-700">{{ $video_processing_job_status->progress_max !== 0 ? round(100 * $video_processing_job_status->progress_now / $video_processing_job_status->progress_max) : 0 }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 ">
                    <div class="bg-blue-600 h-2.5 rounded-full animate-pulse progress-bar-animated"
                         style="width: {{ $video_processing_job_status->progress_max !== 0 ? round(100 * $video_processing_job_status->progress_now / $video_processing_job_status->progress_max) : 0 }}%"></div>
                </div>
            </div>
        </div>
    @endif
    <x-forms.input wire:model.lazy="title">
        Título
    </x-forms.input>
    <x-forms.rte wire:model.lazy="subtitle">
        Sub título
    </x-forms.rte>
    <h1 class="text-md mt-2">
        Tipo da etapa
    </h1>
    <div class="flex gap-2 mt-1">
        <x-forms.button x-bind:class="{'active': type === 'activity'}" @click="type = 'activity'" class="w-full">
            Atividade
        </x-forms.button>
        <x-forms.button x-bind:class="{'active': type === 'video'}" @click="type = 'video'" class="w-full">
            Video
        </x-forms.button>
        <x-forms.button x-bind:class="{'active': type === 'article'}" @click="type = 'article'" class="w-full">
            Artigo
        </x-forms.button>
    </div>
    <div class="border rounded p-3 mt-2">
        <div x-show="type === 'activity'">
            <x-forms.input wire:model.lazy="question_title">
                Título da atividade
            </x-forms.input>
            <div class="block mt-2">
                <div class="block w-full flex items-center align-middle gap-2">
                    <h3 class="text-md">Alternativas</h3>
                    <button @click="Livewire.emit('openModal', 'modals.studio.step.alternative.create')"
                            class="rounded-full focus:bg-gray-200 shadow hover:rounded-lg border h-8 w-8 cursor-pointer transition hover:bg-gray-100 border-gray-200 flex items-center justify-center">
                        <i
                                class="la la-plus "></i></button>
                </div>
                <div>
                    @forelse ($alternatives as $alternative)
                        <div class="p-2 border-t border-b border-gray-200 flex">
                            <span class="w-1/2">{{ $alternative['content'] }}</span>
                            <span class="flex gap-2 justify-end w-1/2">
                            @if ($alternative['is_active'])
                                    <i class="la la-eye text-gray-600"></i>
                                @else
                                    <i class="la la-eye-slash text-gray-600"></i>
                                @endif
                                @if ($alternative['is_correct'])
                                    <i class="la la-check text-green-600"></i>
                                @else
                                    <i class="la la-times text-red-600"></i>
                                @endif
                        </span>
                        </div>
                    @empty
                        <div class="text-center p-4">
                            Crie alternativas clicando no botão acima ou
                            <span class="font-medium underline uppercase cursor-pointer"
                                  @click="Livewire.emit('openModal', 'modals.studio.step.alternative.create')">aqui</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div x-show="type === 'video'">
            <x-forms.rte wire:model.lazy="contents">
                Descrição
            </x-forms.rte>
            <x-forms.filepond wire:model.lazy="video">
                Video
            </x-forms.filepond>
            <div class="flex gap-2 align-middle justify-center items-center">
                <div class="w-2/3 mb-2">
                    <x-forms.filepond wire:model.lazy="thumbnail">
                        Poster <span class="text-sm text-gray-500"> (Thumbnail)</span>
                    </x-forms.filepond>
                    <span class="text-md text-gray-500 px-3">
                            Recomendamos uma imagem com a mesma proporção do video
                    </span>
                </div>
                <div class="w-1/3 m-1 mt-3 border-2 aspect-video border-dashed text-center flex align-middle justify-center items-center">
                    @if ($thumbnail instanceof \Livewire\TemporaryUploadedFile)
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="w-100 fade-in aspect-video shadow" alt="preview">
                    @else
                        <span class="text-md text-gray-500 p-3">
                            Escolha uma foto ao lado ou deixe em branco que <b>vamos gerar uma para você!</b>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div x-show="type === 'article'">
            <x-forms.rte wire:model.lazy="contents">
                Conteúdo
            </x-forms.rte>
        </div>
    </div>
    <div class="flex justify-end">
        <x-forms.button class="mt-3" wire:click="save({{ $course_id }})">Salvar etapa</x-forms.button>
    </div>
</div>
