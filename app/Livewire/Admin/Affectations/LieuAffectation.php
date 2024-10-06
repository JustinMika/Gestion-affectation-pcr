<?php

namespace App\Livewire\Admin\Affectations;

use App\Models\Affectation;
use Livewire\Component;

class LieuAffectation extends Component
{
    public function render()
    {
        return view('livewire.admin.affectations.lieu-affectation', [
            'data' => Affectation::with(['user', 'lieuAffectation'])->get(),
        ]);
    }

    public function deleteEntry(Affectation $affectation)
    {
        if ($affectation) {
            $affectation->delete();
        }
    }
}
