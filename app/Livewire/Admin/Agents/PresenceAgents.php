<?php

namespace App\Livewire\Admin\Agents;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class PresenceAgents extends Component
{
    public $scannedEmployeeId;

    // Liste des événements écoutés
    protected $listeners = ['qrScanned' => 'markAttendance'];

    public function render()
    {
        return view('livewire.admin.agents.presence-agents');
    }

    // Méthode pour marquer la présence
    #[On('qrScanned')]
    public function markAttendance($employeeId)
    {
        try {
            $this->scannedEmployeeId = $employeeId;

            // Vérifier si l'employé existe
            $employee = User::find($employeeId);
            $n = $employee->name;

            if ($employee) {
                // Récupérer l'enregistrement de présence d'aujourd'hui
                $attendance = Attendance::where('user_id', $employeeId)
                    ->whereDate('date', Carbon::today())
                    ->first();

                if ($attendance) {
                    // Vérifier si une heure de sortie (check-out) est déjà enregistrée
                    if ($attendance->check_out_time) {
                        $this->dispatch('returnResponse', [
                            'title' => "Notification",
                            'text' => "$n, vous avez déjà enregistré votre sortie aujourd'hui.",
                            'icon' => 'warning',
                        ]);
                    } else {
                        // Vérifier s'il y a au moins une minute entre les deux scans
                        $lastScanTime = Carbon::parse($attendance->check_in_time);
                        $now = Carbon::now();

                        if ($lastScanTime->diffInMinutes($now) >= 1) {
                            // Enregistrer l'heure de sortie (check-out)
                            $attendance->update(['check_out_time' => $now]);

                            $this->dispatch('returnResponse', [
                                'title' => "Notification de succès",
                                'text' => "$n, votre sortie est enregistrée avec succès.",
                                'icon' => 'success',
                            ]);
                        } else {
                            $this->dispatch('returnResponse', [
                                'title' => "Notification d'erreur",
                                'text' => "$n, il doit s'écouler au moins 1 minute entre deux scans.",
                                'icon' => 'error',
                            ]);
                        }
                    }
                } else {
                    // Si aucune présence pour aujourd'hui, enregistrer le check-in (entrée)
                    Attendance::create([
                        'user_id' => $employeeId,
                        'date' => Carbon::today(),
                        'check_in_time' => Carbon::now(),
                        'status' => 'present',
                    ]);

                    $this->dispatch('returnResponse', [
                        'title' => "Notification de succès",
                        'text' => "$n, votre entrée est enregistrée avec succès.",
                        'icon' => 'success',
                    ]);
                }

            } else {
                // Si l'employé n'est pas trouvé
                $this->dispatch('returnResponse', [
                    'title' => "Notification d'erreur",
                    'text' => "Erreur : Employé non trouvé.",
                    'icon' => 'error',
                ]);
            }
        } catch (\Exception $exception) {
            // En cas d'erreur, capturer l'exception
            $this->dispatch('returnResponse', [
                'title' => "Erreur",
                'text' => "Erreur : " . $exception->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
