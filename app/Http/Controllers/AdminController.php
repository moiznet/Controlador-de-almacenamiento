<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\user_roles;
use App\Models\gruposc;
use App\Models\grupos;
use App\Models\userCuota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;  
class AdminController extends Controller
{
    public function createUser(Request $request)
        {
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|max:255',
            ]);
            
            

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $newUserId = $user->id; 

            $user_roles = user_roles::create([
                'Role' => $request->role,
                'user' => $newUserId,
              
            ]);

            $user_roles2 = grupos::create([
                'grupos' => null,
                'user_id' => $newUserId,
              
            ]);

            $user_roles = userCuota::create([
                'user_id' => $newUserId,
                'couta_user' => 20000,
              
            ]);


            
                return "Usuario Creado con id".$newUserId;
               
        
        
        }

        public function editUserRol(Request $request)
        {
            

            $user_roles = user_roles::updateOrCreate(
                ['user' => $request->edit_user_role_id], // Constraints to find the record
                ['Role' => $request->edit_role] // Values to update or create with
            );


            
                return "Usuario Creado con id";

        
        }


        public function crearGrupo(Request $request)
        {
            
            $request->validate([
                'nombre' => 'required|string|max:255|unique:grupos_tabla',
                'descripcion' => 'string|max:255',
            ]);
            
            

             
             

            $gruposc = gruposc::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
              
            ]);


            
                return "Se creo el nuevo Grupo";
               
        
        
        }

        public function getGrupos(Request $request)
        {
             //return response()->json(['message' => 'found'], 200);

            $grupos_tabla = DB::table('grupos_tabla')->get(); 
            
                if (!$grupos_tabla) {
                    return response()->json(['message' => 'User not found'], 404);
                }

                return response()->json($grupos_tabla);
               
        
        
        }

        public function editUserGrupos(Request $request)
        {
            
            
            
            

            $user_grupos = grupos::updateOrCreate(
                ['user_id' => $request->user_id], // Constraints to find the record
                ['grupos' => $request->grupos] // Values to update or create with
            );


            
                return "Usuario Editado con id";
               
        
        
        }

                public function editUserCuota(Request $request)
        {
            
            
             
            

            $user_grupos = userCuota::updateOrCreate(
                ['user_id' => $request->user_id], // Constraints to find the record
                ['couta_user' => $request->couta_user] // Values to update or create with
            );


            
                return "Usuario Editado con id";
               
        
        
        }


        public function borrarGrupo(Request $request)
        {
            
            
            

            DB::table('grupos_tabla')
            ->where('id', $request->grupo_id) 
            ->delete(); 
              



            
                return "Grupo Borrado";
               
        
        
        }

        public function borrarUsuario(Request $request)
        {
            
            
            

            DB::table('users')
            ->where('id', $request->usuario_id) 
            ->delete(); 
              



            
                return "Usuario Borrado";
               
        
        
        }

}
