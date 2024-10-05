<?php

namespace App\Livewire\User;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    public $permissions;
    public function render()
    {
        return view('livewire.user.permissions', [
            'permission' => []
        ]);
    }

    public function AddPermission()
    {
        $this->validate([
            'permissions' => 'required|min:3'
        ]);
        try {
            Permission::firstOrCreate(['name' => $this->permissions, 'guard_name' => 'web']);
            $this->reset('permissions');
            return back()->with('success', 'permission ajoute avec succes.');
        } catch (\Exception $e) {
            return back()->with('error', "erreur : " . $e->getMessage());
        }
    }

    public function deletePermission(Permission $p)
    {
        try {
            $p->delete();
            return back()->with('_error_', 'permission ajoute avec succes.');
        } catch (\Exception $e) {
            return back()->with('_error_', "erreur : " . $e->getMessage());
        }
    }
}
