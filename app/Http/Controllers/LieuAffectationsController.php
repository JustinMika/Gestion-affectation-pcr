<?php

namespace App\Http\Controllers;

class LieuAffectationsController extends Controller
{
    public function addAffectations()
    {
        return view('admin.Affectations.addAffectations');
    }

    public function listLieuAffectations()
    {
        return view('admin.Affectations.listAffectations');
    }

    public function affectaterAgent()
    {
        return view('admin.Affectations.affectaterAgent');
    }

    public function listAgentAffectations()
    {
        return view('admin.Affectations.listAgentAffectations');
    }
}
