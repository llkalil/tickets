<?php

/** @noinspection ALL */

namespace App\Http\Livewire\Tables\Studio;

use App\Classes\Action;
use App\Classes\Button;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Drafts extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Professor', 'teacher.name'),
            Column::make('Título', 'name'),
            Column::make('Descrição', 'description')->format(fn ($value) => strip_tags($value)),
            Column::make('Preço', 'price_real'),
            Column::make('Preço', 'price_market'),
            Column::make('Duração', 'duration'),
            Column::make('Etapas', 'steps_count'),
            Column::make('Ativo', 'is_active')->format(fn ($value) => view('components.tables.boolean', compact('value'))),
            Action::make('Ações')
                ->addButton(function ($value, $column, $row) {
                    return Button::make('Revisar')->openModal('modals.studio.revision', ['course_id' => $row->getKey()]);
                })->addButton(function ($value, $column, $row) {
                    return Button::make('Salvar')->openModal('modals.studio.save', ['course_id' => $row->getKey()]);
                })->addButton(function ($value, $column, $row) {
                    return Button::make('Salvar e publicar')->openModal('modals.studio.save-publish', ['course_id' => $row->getKey()]);
                }),

        ];
    }

    public function query(): Builder
    {
        return auth()->user()->drafts()->withCount('steps')->getQuery();
    }
}
