<?php

namespace App\Livewire\Admin\Agents;

use App\Models\LeaveRequest;
use Livewire\Component;

class DemagesCongesAgents extends Component
{
    public function render()
    {
        return view('livewire.admin.agents.demages-conges-agents', [
            'data' => LeaveRequest::with('employee')->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function Approuver(LeaveRequest $l)
    {
        if ($l) {
            $l->status = 'approved';
            $l->update();
            $this->dispatch('returnResponse', [
                'title' => "succès",
                'text' => "Traitement ok",
                'icon' => 'success',
            ]);
        } else {
            $this->dispatch('returnResponse', [
                'title' => "Erreur",
                'text' => "Erreur,...",
                'icon' => 'error',
            ]);
        }
    }
    public function Rejetter(LeaveRequest $l)
    {
        if ($l) {
            $l->status = 'rejected';
            $l->update();
            $this->dispatch('returnResponse', [
                'title' => "succès",
                'text' => "Traitement ok",
                'icon' => 'success',
            ]);
        } else {
            $this->dispatch('returnResponse', [
                'title' => "Erreur",
                'text' => "Erreur lors du traitrement",
                'icon' => 'error',
            ]);
        }
    }
}
