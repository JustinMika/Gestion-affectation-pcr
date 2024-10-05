<?php

namespace App\Http\Controllers;

class DomainePrmotion extends Controller
{
    public function addDomaine()
    {
        return view('admin.DomainePrmotion.addDomaine');
    }

    public function domaineList()
    {
        return view('admin.DomainePrmotion.domaine-list');
    }

    public function gestionPromotion()
    {
        return view('admin.DomainePrmotion.gestion-promotion');
    }
}
