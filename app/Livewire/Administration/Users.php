<?php

namespace App\Livewire\Administration;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Http\Controllers\Users as UserController;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $name, $email, $phone, $role_id, $password, $confirm_password, $signature, $sceau;
    public $search_input;
    protected $rules = [
        'name' => 'required|min:5|max:15',
        'email' => 'required|email|min:10|unique:users',
        'phone' => 'required|min:9|max:13|unique:users',
        'role_id' => 'required|min:1',
        'password' => 'required|min:8',
        'confirm_password' => 'required|min:8',
    ];

    public function render()
    {
        $s = '%' . $this->search_input . '%';
        return view('livewire.administration.users', [
            'roles' => Role::where('id', '>', 1)->get(),
            'users' => empty($this->search_input) ? User::paginate(10) : User::where('name', 'LIKE', $s)->orWhere('email', 'LIKE', $s)->paginate()
        ]);
    }

    /**
     * saveUsers
     *
     */
    public function saveUsers()
    {
        $this->validate($this->rules);
        try {
            $fillable = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'role_id' => $this->role_id,
                'password' => Hash::make($this->password),
                'signature' => 'signature_path',
                'sceau' => 'sceau_path'
            ];
            $user = User::create($fillable);
            $r = Role::find($this->role_id);
            $this->reset();
            UserController::saveLogs('Save user.');
            return back()->with('success', 'Utilisateur cree');
        } catch (\Throwable $th) {
            return back()->with('success', 'Erreur : ' . $th->getMessage());
        }
    }

    /**
     * deleteUser
     *
     * @param  User $user
     */
    public function deleteUser(User $user)
    {
        if (empty($user)) {
            return back()->with('_error_', 'Erreur');
        }
        $user->delete();
        UserController::saveLogs('Delete user.');
        return back()->with('_error_', 'Utilisateur supprimE');
    }
}
