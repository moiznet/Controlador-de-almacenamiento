<?php


 
use App\Http\Controllers\AuthController; // Or App\Http\Controllers\Auth\AuthController
use App\Http\Controllers\AppController;
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

 



Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
})->name('test');



