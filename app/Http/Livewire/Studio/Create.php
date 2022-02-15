<?php

namespace App\Http\Livewire\Studio;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Create extends Component
{
    public Course $savedCourse;

    public int $course_id = 0;

    public string $title = '';

    public string $description = '';

    public function updated($prop_name, $prop_value)
    {
        if ($this->course_id == 0) {
            $this->savedCourse = Course::create([
                'user_id' => auth()->id(),
                'teacher_id' => auth()->id(),
                'name' => $this->title,
                'description' => $this->description,
                'duration' => 0,
                'is_active' => false,
                'is_draft' => true,
            ]);
            $this->course_id = $this->savedCourse->id;
            $this->emit('createdCourse', $this->course_id);
            $this->emitTo('livewire-toast', 'show', 'Este curso foi salvo como rascunho');
        } else {
            $this->savedCourse->update([
                'teacher_id' => auth()->id(),
                'name' => $this->title,
                'description' => $this->description,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.studio.create');
    }
}
