<?php

namespace App\Livewire\Agents;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class MesPresences extends Component
{
    public function render()
    {
        return view('livewire.agents.mes-presences', [
            'data' => Attendance::where('user_id', '=', Auth::user()->id)->get()
        ]);
    }
}
