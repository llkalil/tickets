<?php

namespace App\Http\Livewire\Tables\Studio;

use App\Classes\Action;
use App\Classes\Button;
use App\Classes\ButtonBuilder;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Courses extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Professor','teacher.name'),
            Column::make('Título','name'),
            Column::make('Descrição','description')->asHtml(),
            Column::make('Duração','duration'),
            Column::make('Ativo','is_active')->format(function ($value){
                return view('components.tables.boolean',compact('value'));
            }),
            Column::make('Passos ativos','active_steps_count'),
            Action::make('Ações')->asDropdown()->addButton(function (){
                return Button::make('Editar')->openModal('test');
            })->addButton(function (){
                return Button::make('Salvar')->openModal('test');
            })->addButton(function (){
                return Button::make('Outra coisa')->openModal('test');
            }),
        ];
    }

    public function query(): Builder
    {
        return auth()->user()->courses()->where('is_draft', false)->withCount('activeSteps')->getQuery();
    }
}
