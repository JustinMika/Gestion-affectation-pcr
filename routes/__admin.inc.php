<?php

use App\Models\Attendance;
use App\Models\LeaveRequest;

Route::get('/', function () {
    $patientsPerMonth = [];
    // Générer un tableau avec tous les mois
    $months = [
        1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Août',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre'
    ];

    // Obtenir les données des patients par mois
    $patientsData = \App\Models\Affectation::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    // Remplir les mois sans données avec des zéros
    foreach ($months as $num => $name) {
        $patientsPerMonth[$name] = $patientsData[$num] ?? 0;
    }

    return view('admin.index', [
        'patient' => 0,
        'present_to_day' => count(\App\Models\Affectation::where('created_at', '=', date("Y-m-d"))->get()),
        'user' => count(\App\Models\User::get()),
        'conges' => count([]),
        'conges_' => count([]),
        'patientsPerMonth' => $patientsPerMonth
    ]);
})->name('Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY');
Route::get('home', function () {
    return view('admin.index');
});
Route::get('administration/access', function () {
    return view('admin.access');
});
Route::get('administration/log-users', function () {
    return view('admin.log-users', [
        'users' => \App\Models\UserLog::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10)
    ]);
});
Route::get('administration/profil-user', \App\Livewire\User\ProfilUsers::class);
Route::get('administration/users', function () {
    return view('admin.users');
});
Route::get('administration/gestion-users', function () {
    return view('admin.gestion-users');
});
Route::get('agents/voir_presence', function () {
    return view('admin.agents.voir_presence');
});
Route::get('agents/demages-conges-agents', function () {
    return view('admin.agents.demages-conges-agents');
});

/**
 * Rapports
 */
Route::get('rapport/list_agents', [\App\Http\Controllers\RapportAdmin::class, 'listAgents'])->name('rapport.list_agents');
Route::get('rapport/rapport_presence', [\App\Http\Controllers\RapportAdmin::class, 'rapportPresence'])->name('rapport.rapport_presence');
Route::get('rapport/agent_en_conges', [\App\Http\Controllers\RapportAdmin::class, 'agentEnConges'])->name('rapport.agent_en_conges');
Route::get('rapport/demande_conges', [\App\Http\Controllers\RapportAdmin::class, 'demandeConges'])->name('rapport.demande_conges');

/**
 * ---------------------------------------------------------------------------------------------
 * log-out
 * _____________________________________________________________________________________________
 */
Route::get('log-out', [\App\Http\Controllers\UserController::class, 'logout'])->name('log-out');
/**
 * ---------------------------------------------------------------------------------------------*/
