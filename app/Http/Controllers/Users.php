<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::check()) {
            $validated = $request->validate([
                'email' => 'required|min:7|email',
                'password' => 'required|min:8',
            ], [
                'email.required' => "Ce champ est requis",
                'password.required' => 'Ce champ est requis'
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], false)) {
                $m = User::where([
                    ['email', '=', $request->email],
                    ['active', '=', 0]
                ])->get();
                if (count($m) > 0) {
                    Users::saveLogs('Tentative de connexion au system.');
                    return back()->with('failed-login', 'Votre compte a ete bloquer par l\'administrateur');
                }
                Users::saveLogs('connexion au system.');
                return redirect()->to('Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY');
            } else {
                return back()->with('failed-login', 'E-mail et/ou mot de passe non valide.');
            }
        }
        return redirect()->to('Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY');
    }

    public static function saveLogs($messages)
    {
        if (!empty($messages)) {
            try {
                $logs = new UserLog();
                $logs->user_id = Auth::user()->id;
                $logs->logs = $messages ?? '-';
                $logs->save();
            } catch (\Throwable $th) {
                return new \Exception($th->getMessage(), 500);
            }
        }
    }

    public function logout(Request $request)
    {
        DB::delete('delete from sessions where user_id = ?', Auth::user()->id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Users::saveLogs('Logout');
        return \redirect('/', 301)->with('failed-login', 'Veuillez vous reconnecter.');
    }
}
