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
        'present_to_day' => count(\App\Models\Affectation::whereDate('created_at', '=', now()->toDateString())->get()),
        'user' => count(\App\Models\User::get()),
        'conges' => count(\App\Models\LieuAffectation::all()),
        'conges_' => count(\App\Models\Affectation::whereDate('created_at', '=', now()->toDateString())->get()),
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
Route::get('rapport/list_agents_prcs', [\App\Http\Controllers\RapportAdmin::class, 'listAgents'])->name('rapport.list_agents_prcs');
Route::get('rapport/affectations', [\App\Http\Controllers\RapportAdmin::class, 'affectations'])->name('rapport.affectations');

/**
 * Affectations
 */
Route::get('lieu-affectation/add', [\App\Http\Controllers\LieuAffectationsController::class, 'addAffectations']);
Route::get('lieu-affectation/list', [\App\Http\Controllers\LieuAffectationsController::class, 'listLieuAffectations']);

Route::get('lieu-affectation/affecter-agents', [\App\Http\Controllers\LieuAffectationsController::class, 'affectaterAgent'])->name('affectations.affecter-agents');
Route::get('lieu-affectation/list-agents-affectation', [\App\Http\Controllers\LieuAffectationsController::class, 'listAgentAffectations'])->name('affectations.list-affectations');

/**
 * ---------------------------------------------------------------------------------------------
 * log-out
 * _____________________________________________________________________________________________
 */
Route::get('log-out', [\App\Http\Controllers\UserController::class, 'logout'])->name('log-out');
/**
 * ---------------------------------------------------------------------------------------------*/
