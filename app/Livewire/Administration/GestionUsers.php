<?php

namespace App\Livewire\Administration;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class GestionUsers extends Component
{
    use WithPagination;
    public $user_id;
    public $name, $email, $phone, $role_id;
    public function render()
    {
        return view('livewire.administration.gestion-users', [
            'roles' => Role::with('HasUser')->get(),
            'users' => User::with('hasRole')->simplePaginate()
        ]);
    }

    /**
     * ChangeActiveUser
     *
     * @param  mixed $userId
     * @param  mixed $id
     * @return void
     */
    public function ChangeActiveUser($userId, $id)
    {
        $booleen = (bool) $id; // Convertit l'entier en booléen
        if (!empty($userId)) {
            $u = User::find($userId);
            $v = (int) !$booleen;
            $u->active = $v;
            $u->update();
        }
    }

    /**
     * ResetPassWord
     *
     * @param  int $id
     * @return void
     */
    public function ResetPassWord(int $id)
    {
        if (!empty($id)) {
            $u = User::find($id);
            $u->password = Hash::make('password');
            $u->update();
        }
    }

    /**
     * setUpdateUser
     *
     * @param  int $id
     * @return void
     */
    public function setUpdateUser(int $id)
    {
        if (!empty($id)) {
            $this->user_id = $id;
            $u = User::find($id);
            $this->name = $u->name;
            $this->email = $u->email;
            $this->phone = $u->phone;
            $this->role_id = $u->role_id;
        }
    }

    /**
     * updateUsers
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function updateUsers(): \Illuminate\Http\RedirectResponse
    {
        try {
            $u = User::find($this->user_id);
            $u->name = $this->name;
            $u->email = $this->email;
            $u->phone = $this->phone;
            $u->role_id = $this->role_id;
            $u->update();
            return back()->with('success', 'Utilisateur mise a jour avec succes.');
        } catch (\Exception $e) {
            return back()->with('_error_', $e->getMessage());
        }
    }

    /**
     * deleteUser
     *
     * @param  User $user
     * @return Illuminate\Http\RedirectResponse
     */
    public function deleteUser(User $user): \Illuminate\Http\RedirectResponse
    {
        if (empty($user)) {
            return back()->with('_error_', 'Erreur');
        }
        $user->delete();
        return back()->with('_error_', 'Utilisateur supprimE');
    }
}
