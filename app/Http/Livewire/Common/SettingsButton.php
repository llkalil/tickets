<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class SettingsButton extends Component
{
    public int $badgeCount = 3;
    public function render()
    {
        return view('livewire.common.settings-button');
    }
}
