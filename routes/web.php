<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Controladores Añadidos
use App\Http\Controllers\PartidoController;

//Controlador Email
use App\Mail\CantactanosMailable;
use Illuminate\Support\Facades\Mail;

// Controlador User
use App\Http\Controllers\UserController;

// Controlador de pistas

use App\Http\Controllers\PistaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Router de Partidos

Route::get('/partidos/crear', [PartidoController::class, 'create'])->name('partidos.create');

/* Apuntarse */
Route::post('/partidos/apuntarse/{partido}', [PartidoController::class, 'inscribirPartido'])->name('partidos.apuntarse');

Route::post('/partidos', [PartidoController::class, 'store'])->name('partidos.store');
Route::get('/partidos/index', [PartidoController::class, 'index'])->name('partidos.index');
Route::get('/partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show');
Route::delete('/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');




//Sacar la el numero para la ubicacion
Route::get('/pistas-por-ubicacion/{ubicacionId}', [PistaController::class, 'pistasPorUbicacion']);



Route::get('/superficie-por-ubicacion/{superficieId}', [PistaController::class, 'pistasPorUbicacion']);

Route::get('/deporte-por-ubicacion/{deporteId}', [PistaController::class, 'pistasPorUbicacion']);


Route::get('/pistas/{pista}', [PistaController::class, 'show']);



Route::get('/pistas/{pista}/deportes', [PistaController::class, 'deportePorPista']);







Route::middleware('auth')->group(function () {
    Route::get('/perfil/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Correo electronico

Route::get('contactanos', function () {

    Mail::to('enriquecuevas1989@gmail.com')->send(new CantactanosMailable);


    return "Mensaje Enviado";
})->name('contactanos');



require __DIR__ . '/auth.php';
