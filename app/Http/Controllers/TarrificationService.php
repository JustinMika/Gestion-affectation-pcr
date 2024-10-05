<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarrificationService extends Controller
{
    public function categoriePersonne()
    {
        return view('admin.Tarrification-service.categorie-personne');
    }

    public function grandServices()
    {
        return view('admin.Tarrification-service.grand-services');
    }

    public function servicesTarif()
    {
        return view('admin.Tarrification-service.services-tarif');
    }

    public function tarif()
    {
        return view('admin.Tarrification-service.tarif');
    }
}
