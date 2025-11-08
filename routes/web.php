<?php


 
use App\Http\Controllers\AuthController; // Or App\Http\Controllers\Auth\AuthController
use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/archivos', [AppController::class, 'ShowArchivos'])->name('archivos');
Route::get('/usuarios', [AppController::class, 'ShowUsuarios'])->name('usuarios');

 

Route::post('/upload', [FileController::class, 'uploadFile']);


Route::post('/create_user', [AdminController::class, 'createUser']);

Route::post('/edit_user_rol', [AdminController::class, 'editUserRol']);

Route::post('/crear_grupo', [AdminController::class, 'crearGrupo']);

Route::get('/get_grupos', [AdminController::class, 'getGrupos']);

Route::post('/edit_user_grupos', [AdminController::class, 'editUserGrupos']);

Route::post('/borrar_grupo', [AdminController::class, 'borrarGrupo']);

Route::post('/borrar_usuario', [AdminController::class, 'borrarUsuario']);

Route::post('/borrar_archivo', [FileController::class, 'borrarArchivo']); 

Route::post('/edit_user_cuota', [AdminController::class, 'editUserCuota']);

Route::post('/getrol', [AdminController::class, 'getRol']);



Route::get('/', function () {
    return view('test');
});
Route::get('/test', function () {
    return view('test');
})->name('test');



