<?php
Route::get('agents/affectation-now', [\App\Http\Controllers\AgentController::class, 'affectationsNow'])->name('agents.affectation');
Route::get('agent/demande_conges', [\App\Http\Controllers\AgentController::class, 'MesAffectation'])->name('agents.demande_conges');
