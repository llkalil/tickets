<?php

namespace App\Http\Livewire\Studio\Steps;

use App\Models\Course;
use Livewire\Component;

class ShowAll extends Component
{
    public $steps;

    public $course_id;

    protected $listeners = [
        'stepCreated' => 'getSteps',
    ];

    public function mount()
    {
        $this->getSteps($this->course_id);
    }

    public function render()
    {
        return view('livewire.studio.steps.show-all');
    }

    public function getSteps($course_id)
    {
        if ($course_id == null || $course_id == 0) {
            $this->steps = [];
        } else {
            $this->steps = Course::find($course_id)->steps;
        }
    }
}
