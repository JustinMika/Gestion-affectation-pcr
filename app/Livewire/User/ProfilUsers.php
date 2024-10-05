<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilUsers extends Component
{
    public $nom_, $phone, $adresse, $email, $id_user,$userId;
    public $password, $new_password, $old_password;

    public function mount()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $this->userId = Auth::user()->id;

        $this->id_user = Auth::user()->id;
        $this->nom_ = Auth::user()->name;
        $this->phone = Auth::user()->phone;
        $this->email = Auth::user()->email;
        $this->adresse = Auth::user()->adresse;
    }
    public function render()
    {
        return view('livewire.user.profil-users');
    }

    public function saveProfilInfo()
    {
        $this->validate([
            'nom_' => 'required',
            'phone' => 'required|min:9',
            'email' => 'required|min:5|email',
            'adresse' => 'required|min:4'
        ]);

        try {
            $u = User::find(Auth::user()->id);
            $u->name = $this->nom_;
            $u->email = $this->email;
            $u->phone = $this->phone;
            $u->adresse = $this->adresse;
            $u->update();
            return back()->with("success", "Informations mises à jour avec succes");
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function updatePasswordUsers()
    {
        $this->validate([
            'old_password' => 'required',
            'password' => 'required|min:8',
            'new_password' => 'required|required_with:password|min:8',
        ]);

        try {
            $u = User::find(Auth::user()->id);
            if ($this->password !== $this->new_password) {
                return back()->with('_error_', 'Les deux mot de passent ne correspondent pas.');
            }

            if (Hash::make($this->password) !== Auth::user()->password) {
                return back()->with('_error_', 'L\'ancien mot de passe est incorect.');
            }
            $u->password = Hash::make($this->password);
            $u->update();
            return back()->with("_success_", "Mot de passe mises à jour avec succes");
        } catch (\Exception $e) {
            return back()->with('_error_', 'Erreur : ' . $e->getMessage());
        }
    }
}
