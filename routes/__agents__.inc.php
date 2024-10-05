<?php
Route::get('agents/mes_presences', [\App\Http\Controllers\AgentController::class, 'mesPresences'])->name('agents.mes_presences');
Route::get('agent/demande_conges', [\App\Http\Controllers\AgentController::class, 'demandeConges'])->name('agents.demande_conges');
Route::get('agents/list_demande_conges', [\App\Http\Controllers\AgentController::class, 'listDemandeConges'])->name('agents.list_demande_conges');
