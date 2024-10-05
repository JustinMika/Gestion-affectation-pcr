<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Documentation extends Controller
{
    public function DocumentationApp()
    {
        return view('admin.documentation.documentation');
    }
}
