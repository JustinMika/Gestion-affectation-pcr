<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationButton extends Component
{
    public $nbre = 0;
    public function render()
    {
        $this->nbre += 1;
        return view('livewire.notification-button');
    }
}
