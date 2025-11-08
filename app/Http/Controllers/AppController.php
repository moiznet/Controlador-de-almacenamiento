<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
class AppController extends Controller
{
    public function ShowArchivos()
    {   
        $userId = auth()->id();
        $data = DB::table('files_table')->where('userid', $userId)->get();

        return view('archivos', compact('data')); // Assuming you have a login Blade view
    }

    public function ShowUsuarios()
    {
       $products = DB::table('users')->join('user_roles', 'users.id', '=', 'user_roles.user')->join('grupo_tabla', 'users.id', '=', 'grupo_tabla.user_id')->select('users.id','users.name', 'users.email', 'user_roles.Role', 'grupo_tabla.grupos')->get();
       
       
       return view('usuarios', compact('products')); // Assuming you have a login Blade view
    }
}
