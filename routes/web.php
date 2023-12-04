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

// Contrrolador de Paypal
use App\Http\Controllers\PaypalController;


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
Route::post('/partidos/{partido}/inscribirse', [PartidoController::class, 'inscribirPartido'])->name('partidos.inscribirse');

/* Desapuntarse */
Route::post('/partidos/{partido}/desapuntarse', [PartidoController::class, 'desapuntarse'])->name('partidos.desapuntarse');



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


// Pago con paypal

// routes/.php

Route::post('/payment/create', [PaypalController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/success', [PaypalController::class, 'successPayment'])->name('payment.success');
Route::get('/payment/cancel', [PaypalController::class, 'cancelPayment'])->name('payment.cancel');
Route::get('/payment/error', [PaypalController::class, 'errorPayment'])->name('payment.error');







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
