<div
        wire:ignore
        x-data
        x-init="() => {
        const post = FilePond.create($refs.input);
        post.setOptions({
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
            }
        });
    }"
>
    <label class="block text-sm font-medium text-gray-700 leading-5 mt-2 mb-2">
        {{ $slot ?? '' }}
    </label>
    <div class="@error($attributes->whereStartsWith('wire:model')->first()) border-2 rounded-lg shadow border-red-400 ring-1 ring-red-300 @enderror">
        <input type="file" x-ref="input" {{ $attributes }}/>
    </div>

    @error($attributes->whereStartsWith('wire:model')->first())
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

