<?php

namespace App\Http\Livewire\Modals\Studio;

use App\Models\Course;
use LivewireUI\Modal\ModalComponent;

class Revision extends ModalComponent
{
    public $course_id;

    public Course $course;

    public function mount()
    {
        $this->course = auth()->user()->courses->find($this->course_id);
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.modals.studio.revision');
    }
}
