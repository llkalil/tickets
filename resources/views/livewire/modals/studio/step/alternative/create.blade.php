<div class="p-4">
    <h1 class="text-lg">
        Nova alternativa
    </h1>

    <x-forms.input wire:model.lazy="title">
        Titulo
    </x-forms.input>

    <div class="">
        <x-foms.switch checked wire:model="is_active">Ativa</x-foms.switch>
        <x-foms.switch wire:model="is_correct">Alternativa correta</x-foms.switch>
    </div>
    <div class="w-full flex gap-2 mt-4">
        <x-forms.button-secondary class="w-full" wire:click="cancel">
            Cancelar
        </x-forms.button-secondary >
        <x-forms.button class="w-full" wire:click="save">
            Salvar
        </x-forms.button>
    </div>
</div>
