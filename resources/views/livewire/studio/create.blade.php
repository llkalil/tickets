<div class="flex gap-2">


    <div class="w-2/3">
        <h1 class="text-xl">
            Novo curso
            <span wire:loading class="float-right text-sm text-gray-500">
                Salvando...
            </span>
        </h1>
        <x-forms.input wire:model.lazy="title">
            Título
        </x-forms.input>
        <x-forms.rte wire:model.lazy="description">
            Descrição
        </x-forms.rte>
        <h1 class="text-xl mt-3">
            Adicionar etapa
        </h1>
        @livewire('studio.steps.create')

    </div>
    <div class="w-1/3">
        <h1 class="text-xl">
            Passos
        </h1>
        @livewire('studio.steps.show-all')
    </div>
</div>
