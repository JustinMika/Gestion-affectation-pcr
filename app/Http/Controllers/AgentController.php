<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function mesPresences()
    {
        return view('admin.agents.mes-presence');
    }
    public function demandeConges()
    {
        return view('admin.agents.demande-conges');
    }
    public function listDemandeConges()
    {
        return view('admin.agents.list_demande_conges', [
            'data' => LeaveRequest::where('user_id', '=', Auth::user()->id)->get()
        ]);
    }
}
