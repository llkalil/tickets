<?php

namespace App\Http\Livewire\Modals\Studio\Step\Alternative;

use App\Models\Alternative;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $title;
    public $is_active;
    public $is_correct;

    public function render()
    {
        return view('livewire.modals.studio.step.alternative.create');
    }

    public function save()
    {
        $alternative = new Alternative();
        $alternative->course_step_id = null;
        $alternative->content = $this->title;
        $alternative->is_correct = $this->is_correct;
        $alternative->is_active = $this->is_active;

        $this->emit('createdAlternative', $alternative);
        $this->closeModal();
        $this->emitTo('livewire-toast', 'show', 'Alternativa adicionada');
    }

    public function cancel()
    {
        $this->closeModal();
    }
}
