<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class MessagerieInterne extends Component
{
    public function render()
    {
        return view('livewire.user.messagerie-interne', [
            'user' => User::all()
        ]);
    }
}
