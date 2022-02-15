<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class DraftsButton extends Component
{
    public $drafts_count = 0;

    protected $listeners = [
        'createdCourse' => 'getDraftsCount',
    ];

    public function mount()
    {
        $this->getDraftsCount();
    }

    public function render()
    {
        return view('livewire.common.drafts-button');
    }

    public function getDraftsCount()
    {
        $this->drafts_count = auth()->user()->drafts->count();
    }
}
