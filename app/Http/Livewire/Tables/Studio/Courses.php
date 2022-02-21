<?php

namespace App\Http\Livewire\Tables\Studio;

use App\Classes\Action;
use App\Classes\Button;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Courses extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Professor', 'teacher.name'),
            Column::make('Título', 'name'),
            Column::make('Descrição', 'description')->asHtml(),
            Column::make('Duração', 'duration'),
            Column::make('Ativo', 'is_active')->format(fn ($value) => view('components.tables.boolean', compact('value'))),
            Column::make('Passos ativos', 'active_steps_count'),
            Action::make('Ações')->asDropdown()->addButton(fn () => Button::make('Editar')->openModal('test'))->addButton(fn () => Button::make('Salvar')->openModal('test'))->addButton(fn () => Button::make('Outra coisa')->openModal('test')),
        ];
    }

    public function query(): Builder
    {
        return auth()->user()->courses()->where('is_draft', false)->withCount('activeSteps')->getQuery();
    }
}
