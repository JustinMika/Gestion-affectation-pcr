<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePersmissions extends Component
{
    public $list_permission_roles = [], $search_input, $roles_;
    public function render()
    {
        $roles = Role::with('permissions')->paginate();
        // dd(DB::table('permissions')->get());

        $rolePermissions = DB::table('role_has_permissions')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('roles.name as role_name', 'permissions.name as permission_name', 'roles.guard_name', 'roles.created_at')
            ->paginate(10);

        return view('livewire.user.role-persmissions', [
            'permission' => $roles,
            'roles' => Role::all(),
            'permission_list' => DB::table('permissions')->get()
        ]);
    }

    public function AddPermission()
    {
        $this->validate([
            'roles_' => 'required',
            'list_permission_roles' => 'required'
        ]);

        try {
            $role = Role::find($this->roles_);
            $list_p = [];

            foreach ($this->list_permission_roles as $per => $p) {
                $m = Permission::find($p);
                $list_p[] = $m->name;
            }

            $role->givePermissionTo($list_p);
            $this->reset(['list_permission_roles', 'roles_']);
            return back()->with('success', 'Permission accordees avec succes.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage() . 'online : ' . $e->getLine());
        }
    }

    public function deletePersmissions($p)
    {
        // dd($p);
        try {
            if (!empty($p)) {
                $p = Permission::find($p);
                $p->delete();
            }
            return back()->with('_error_', 'Permission supprime avec succees.');
        } catch (\Exception $e) {
            return back()->with('_error_', 'Erreur : ' . $e->getMessage() . 'online : ' . $e->getLine());
        }
    }
}
