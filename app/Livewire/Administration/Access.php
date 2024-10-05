<?php

namespace App\Livewire\Administration;

use App\Models\Role;
use Livewire\Component;
use App\Http\Controllers\Users;
use Illuminate\Http\RedirectResponse;

class Access extends Component
{
    public $acces;
    public function render()
    {
        $roles = Role::all() ?? [];
        return view('livewire.administration.access', compact('roles'));
    }

    /**
     * saveRole
     *
     * @return void
     */
    public function saveRole() : RedirectResponse
    {
        $this->validate([
            'acces' => 'required|min:4|unique:roles,name'
        ]);
        try {
            Role::create(['name' => $this->acces]);
            $this->reset('acces');
            Users::saveLogs('Save Access.');
            return back()->with('success', 'Acces crée.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erreur : ' . $th->getMessage());
        }
    }

    public function DeleteAccess(Role $role)
    {
        if (!empty($role)) {
            $role->delete();
            return back()->with('_error_', 'Acces supprimée.');
        }
    }
}
