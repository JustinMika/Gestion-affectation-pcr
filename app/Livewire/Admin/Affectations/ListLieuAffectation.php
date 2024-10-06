<?php

namespace App\Livewire\Admin\Affectations;

use Livewire\Component;

class ListLieuAffectation extends Component
{
    public function render()
    {
        return view('livewire.admin.affectations.list-lieu-affectation', [
            'lieu' => \App\Models\LieuAffectation::all(),
        ]);
    }
}
