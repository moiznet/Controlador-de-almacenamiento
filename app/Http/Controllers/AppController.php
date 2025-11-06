<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function ShowArchivos()
    {
        return view('archivos'); // Assuming you have a login Blade view
    }

    public function ShowUsuarios()
    {
        return view('usuarios'); // Assuming you have a login Blade view
    }
}
