<div class="my-1 border border-gray-200 shadow-sm p-4 rounded-md" x-data="{ type: @entangle('type') }">
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
