<?php

use App\Http\Controllers\HomeController;
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

/* Controlador Chat */

use App\Http\Controllers\MensajeController;

/* CONTROLADORES ADMIN */
use App\Http\Controllers\AdminUserController;

/*Controlador de Admin Deportes
 */
use App\Http\Controllers\AdminDeporteController;


/* Controler  Admin Ubicacion */
use App\Http\Controllers\AdminUbicacionController;


/* Controler de Admin Superficie */

use App\Http\Controllers\AdminSuperficieController;

/* Controller de Admin Pista */
use App\Http\Controllers\AdminPistaController;

/* Comentarios */

use App\Http\Controllers\ComentarioController;



use App\Models\Deporte;

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
})->name('welcome');

/* Cookies y Privacidad */


Route::get('/cookies_privacidad', function () {
    return view('cookies_privacidad');
})->name('politicas.cookies.privacidad');

Route::get('/politicas_privacidad', function () {
    return view('politicas_privacidad');
})->name('politicas.privacidad');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ADMIN */
Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('admin.index');

//Router de Partidos

Route::get('/partidos/crear', [PartidoController::class, 'create'])->name('partidos.create');

/* Apuntarse */
Route::post('/partidos/{partido}/inscribirse', [PartidoController::class, 'inscribirPartido'])->name('partidos.inscribirse');

/* Desapuntarse */
Route::post('/partidos/{partido}/desapuntarse', [PartidoController::class, 'desapuntarse'])->name('partidos.desapuntarse');



/* Confirmar pago */

Route::post('/actualizar-estado-pago/{partido}', [PartidoController::class, 'actualizarEstadoPago'])
    ->name('actualizar_estado_pago');

Route::post('/partidos', [PartidoController::class, 'store'])->name('partidos.store');
Route::get('/partidos/index', [PartidoController::class, 'index'])->name('partidos.index');
Route::get('/partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show');
Route::delete('/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');


/* Controlar las horas */

Route::get('/obtener-horas-ocupadas/{ubicacionId}', [PartidoController::class, 'obtenerHorasOcupadas']);

//Sacar la el numero para la ubicacion
Route::get('/pistas-por-ubicacion/{ubicacionId}', [PistaController::class, 'pistasPorUbicacion']);



Route::get('/superficie-por-ubicacion/{superficieId}', [PistaController::class, 'pistasPorUbicacion']);

Route::get('/deporte-por-ubicacion/{deporteId}', [PistaController::class, 'pistasPorUbicacion']);


Route::get('/pistas/{pista}', [PistaController::class, 'show']);



Route::get('/pistas/{pista}/deportes', [PistaController::class, 'deportePorPista']);


/* Routes para admin */


/* Route user Admin */

Route::get('/admin/index', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');



/* Route Admin Ubicacion */

Route::get('/admin/ubicacion', [AdminUbicacionController::class, 'index'])->name('admin.ubicacion.index');
Route::get('/admin/ubicacion/create', [AdminUbicacionController::class, 'create'])->name('admin.ubicacion.create');
Route::post('/admin/ubicacion', [AdminUbicacionController::class, 'store'])->name('admin.ubicacion.store');
Route::get('/admin/ubicacion/{ubicacion}/edit', [AdminUbicacionController::class, 'edit'])->name('admin.ubicacion.edit');
Route::put('/admin/ubicacion/{ubicacion}', [AdminUbicacionController::class, 'update'])->name('admin.ubicacion.update'); // Utiliza PUT para actualizar
Route::delete('/admin/ubicacion/{ubicacion}', [AdminUbicacionController::class, 'destroy'])->name('admin.ubicacion.destroy');




/* Route Admin Deporte */

Route::get('/admin/deportes', [AdminDeporteController::class, 'index'])->name('admin.deportes.index');
Route::get('/admin/deportes/create', [AdminDeporteController::class, 'create'])->name('admin.deportes.create');
Route::post('/admin/deportes', [AdminDeporteController::class, 'store'])->name('admin.deportes.store');
Route::get('/admin/deportes/{deporte}/edit', [AdminDeporteController::class, 'edit'])->name('admin.deportes.edit');
Route::put('/admin/deportes/{deporte}', [AdminDeporteController::class, 'update'])->name('admin.deportes.update');
Route::delete('/admin/deportes/{deporte}', [AdminDeporteController::class, 'destroy'])->name('admin.deportes.destroy');


/* Route Admin Superficie   */


Route::get('/admin/superficie', [AdminSuperficieController::class, 'index'])->name('admin.superficie.index');
Route::get('/admin/superficie/create', [AdminSuperficieController::class, 'create'])->name('admin.superficie.create');
Route::post('/admin/superficie', [AdminSuperficieController::class, 'store'])->name('admin.superficie.store');
Route::get('/admin/superficie/{superficie}/edit', [AdminSuperficieController::class, 'edit'])->name('admin.superficie.edit');
Route::put('/admin/superficie/{superficie}', [AdminSuperficieController::class, 'update'])->name('admin.superficie.update');
Route::delete('/admin/superficie/{superficie}', [AdminSuperficieController::class, 'destroy'])
    ->name('admin.superficie.destroy');


/*
Route::get('/admin/superficie/index', [AdminSuperficieController::class, 'index'])->name('admin.superficie.index');
Route::get('/admin/superficie/create', [AdminSuperficieController::class, 'create'])->name('admin.superficie.create');
Route::post('/admin/superficie/store', [AdminSuperficieController::class, 'store'])->name('admin.superficie.store');
 */



/* Route Admin Pistas */

Route::get('/admin/pista/index', [AdminPistaController::class, 'index'])->name('admin.pista.index');
Route::get('/admin/pista/create', [AdminPistaController::class, 'create'])->name('admin.pista.create');
Route::post('/admin/pista/store', [AdminPistaController::class, 'store'])->name('admin.pista.store');
Route::get('/admin/pista/edit/{pista}', [AdminPistaController::class, 'edit'])->name('admin.pista.edit');
Route::put('/admin/pista/update/{pista}', [AdminPistaController::class, 'update'])->name('admin.pista.update');
Route::delete('/admin/pista/{pista}', [AdminPistaController::class, 'destroy'])->name('admin.pista.destroy');










Route::middleware('auth')->group(function () {
    Route::get('/perfil/{user}', [UserController::class, 'show'])->name('user.show');

    // Rutas para editar y actualizar el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para editar y actualizar la foto del perfil
    Route::get('/profile/edit-foto', [ProfileController::class, 'editFoto'])->name('profile.edit-foto');
    Route::post('/profile/update-foto', [ProfileController::class, 'updateFoto'])->name('profile.update-foto');

    // Ruta para mostrar el perfil después de la actualización de la foto
    Route::get('/profile/show/{user}', [ProfileController::class, 'show'])->name('profile.show');
});


/* Comentarios */
// Rutas para comentarios
Route::get('/comentarios/{partidoId}', [ComentarioController::class, 'index'])->name('comentarios.index');
Route::post('/partidos/{partidoId}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::post('/partidos/{partido}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');


/* Intento Chat */
Route::get('/mensajes/{partidoId}', [MensajeController::class, 'index'])->name('mensajes.index')->middleware('web');
Route::get('/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');


//Correo electronico

Route::get('contactanos', function () {

    Mail::to('enriquecuevas1989@gmail.com')->send(new CantactanosMailable);


    return "Mensaje Enviado";
})->name('contactanos');



require __DIR__ . '/auth.php';
