<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function affectationsNow()
    {
        return view('agents.affectation-actuelle', [
            'affectation' => Affectation::with(['user', 'lieuAffectation'])->where('user_id', '=', Auth::user()->id)->get()
        ]);
    }
    
    public function MesAffectation()
    {
        return view('agents.mes-affectation', [
            'list_affectation' => Affectation::with(['user', 'lieuAffectation'])->where('user_id', '=', Auth::user()->id)->get()
        ]);
    }
}
