<?php

namespace App\Http\Livewire\Tables\Studio;

use App\Classes\Button;
use App\Classes\ButtonBuilder;
use Faker\Provider\ar_EG\Color;
use Illuminate\Database\Eloquent\Builder;
use Psy\Command\BufferCommand;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Drafts extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Professor', 'teacher.name'),
            Column::make('Título', 'name'),
            Column::make('Descrição', 'description')->format(function ($value) {
                return strip_tags($value);
            }),
            Column::make('Preço', 'price_real'),
            Column::make('Preço', 'price_market'),
            Column::make('Duração', 'duration'),
            Column::make('Ativo', 'is_active')->format(function ($value) {
                return view('components.tables.boolean', compact('value'));
            }),
            Column::make('Rascunho', 'is_draft')->format(function ($value) {
                return view('components.tables.boolean');
            }),

            Button::make('Ações', null)->addButton(function () {
                return ButtonBuilder::make('ois')->color('indigo')->emit('asdasd', 1, 2, 3, 4, true, 'asdasd')->create();
            }),

        ];
    }

    public function query(): Builder
    {
        return auth()->user()->drafts()->getQuery();
    }
}
