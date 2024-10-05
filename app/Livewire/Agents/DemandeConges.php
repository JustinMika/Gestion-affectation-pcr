<?php

namespace App\Livewire\Agents;

use Livewire\Component;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class DemandeConges extends Component
{
    public $date_start, $date_fin, $motif;
    public function render()
    {
        return view('livewire.agents.demande-conges');
    }

    public function CreerEtatdeBesoins()
    {
        $this->validate([
            'date_start' => 'date|required',
            'date_fin' => 'date|required',
            'motif' => 'required|min:10',
        ]);

        try {
            $fillable = ['user_id' => Auth::user()->id, 'start_date' => $this->date_start, 'end_date' => $this->date_fin, 'reason' => $this->motif];
            LeaveRequest::create($fillable);
            $this->reset();
            $this->dispatch('create', [
                'title' => "succès",
                'text' => "Demande de conge crée avec succès.",
                'icon' => 'success',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('create', [
                'title' => "Erreur",
                'text' => "Erreur : " . $th->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
