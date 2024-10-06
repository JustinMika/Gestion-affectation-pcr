<?php

namespace App\Livewire\Admin\Affectations;

use Livewire\Component;

class AddLieuAffectation extends Component
{
    public $lieu_affactation;

    public function render()
    {
        return view('livewire.admin.affectations.add-lieu-affectation');
    }


    public function CreerLieuAffact()
    {
        $this->validate([
            'lieu_affactation' => 'required|min:5|max:255',
        ]);

        try {
            $fillable = [
                'lieu' => $this->lieu_affactation,
            ];
            \App\Models\LieuAffectation::create($fillable);
            $this->reset();
            $this->dispatch('create', [
                'title' => "succès",
                'text' => "Lieu d'affectation crée avec succès.",
                'icon' => 'success',
            ]);
        } catch (\Exception $th) {
            $this->dispatch('create', [
                'title' => "error",
                'text' => "Erreur : " . $th->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
