<?php

namespace App\Livewire\Admin\Affectations;

use App\Models\User;
use Livewire\Component;

class AffecterAgentsPcr extends Component
{
    public $lieu_, $agent_pcr;

    public function render()
    {
        return view('livewire.admin.affectations.affecter-agents-pcr', [
            'agents_pcr' => User::where('id', '!=', 1)->get(),
            'lieu_affect' => \App\Models\LieuAffectation::all()
        ]);
    }

    public function saveAffectation()
    {
        $this->validate([
            'lieu_' => 'required|min:1',
            'agent_pcr' => 'required|min:1',
        ]);

        try {
            $fillable = [
                'user_id' => $this->agent_pcr,
                'lieu_affectation_id' => $this->lieu_,
            ];
            \App\Models\Affectation::create($fillable);
            $this->reset();
            $this->dispatch('create', [
                'title' => "succès",
                'text' => "Agent affecter avec succès.",
                'icon' => 'success',
            ]);
        } catch (Exception $e) {
            $this->dispatch('create', [
                'title' => "error",
                'text' => "Erreur : " . $th->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
