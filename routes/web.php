<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDeporteController;
use App\Http\Controllers\AdminPistaController;
use App\Http\Controllers\AdminSuperficieController;
use App\Http\Controllers\AdminUbicacionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PistaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Pista;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/cookies_privacidad', fn () => view('cookies_privacidad'))
    ->name('politicas.cookies.privacidad');

Route::get('/politicas_privacidad', fn () => view('politicas_privacidad'))
    ->name('politicas.privacidad');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/partidos/crear', [PartidoController::class, 'create'])->name('partidos.create');
    Route::post('/partidos', [PartidoController::class, 'store'])->name('partidos.store');
    Route::get('/partidos/index', [PartidoController::class, 'index'])->name('partidos.index');
    Route::get('/partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show');
    Route::delete('/partidos/{partido}', [PartidoController::class, 'destroy'])->name('partidos.destroy');

    Route::post('/partidos/{partido}/inscribirse', [PartidoController::class, 'inscribirPartido'])
        ->name('partidos.inscribirse');
    Route::post('/partidos/{partido}/desapuntarse', [PartidoController::class, 'desapuntarse'])
        ->name('partidos.desapuntarse');

    Route::get('/partidos/{partido}/paypal/pagar', [PayPalController::class, 'start'])
        ->name('paypal.start');
    Route::get('/partidos/{partido}/paypal/volver', [PayPalController::class, 'return'])
        ->name('paypal.return');
    Route::get('/partidos/{partido}/paypal/cancelar', [PayPalController::class, 'cancel'])
        ->name('paypal.cancel');

    Route::get('/ubicaciones/{ubicacion}/clima', [PartidoController::class, 'climaUbicacion'])
        ->name('ubicaciones.clima');

    Route::get('/obtener-horas-ocupadas/{pista}/{fecha}', [PartidoController::class, 'obtenerHorasOcupadas'])
        ->name('pistas.horas-ocupadas');
    Route::get('/pistas-por-ubicacion/{ubicacion}', [PistaController::class, 'pistasPorUbicacion'])
        ->name('pistas.por-ubicacion');
    Route::get('/pistas/{pista}', [PistaController::class, 'show'])
        ->name('pistas.show');

    Route::get('/partidos/{partido}/clima', [PartidoController::class, 'clima'])->name('partidos.clima');

    Route::post('/partidos/{partido}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

    Route::get('/partidos/{partido}/mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::post('/partidos/{partido}/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');

    Route::get('/perfil/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-foto', [ProfileController::class, 'updateFoto'])->name('profile.update-foto');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('admin.index');

    Route::redirect('/index', '/admin/users', 301);
    Route::redirect('/pista/index', '/admin/pista', 301);
    Route::get('/pista/edit/{pista}', fn (Pista $pista) => redirect()->route('admin.pista.edit', $pista, 301));

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/ubicacion', [AdminUbicacionController::class, 'index'])->name('admin.ubicacion.index');
    Route::get('/ubicacion/create', [AdminUbicacionController::class, 'create'])->name('admin.ubicacion.create');
    Route::post('/ubicacion', [AdminUbicacionController::class, 'store'])->name('admin.ubicacion.store');
    Route::get('/ubicacion/{ubicacion}/edit', [AdminUbicacionController::class, 'edit'])->name('admin.ubicacion.edit');
    Route::put('/ubicacion/{ubicacion}', [AdminUbicacionController::class, 'update'])->name('admin.ubicacion.update');
    Route::delete('/ubicacion/{ubicacion}', [AdminUbicacionController::class, 'destroy'])->name('admin.ubicacion.destroy');

    Route::get('/deportes', [AdminDeporteController::class, 'index'])->name('admin.deportes.index');
    Route::get('/deportes/create', [AdminDeporteController::class, 'create'])->name('admin.deportes.create');
    Route::post('/deportes', [AdminDeporteController::class, 'store'])->name('admin.deportes.store');
    Route::get('/deportes/{deporte}/edit', [AdminDeporteController::class, 'edit'])->name('admin.deportes.edit');
    Route::put('/deportes/{deporte}', [AdminDeporteController::class, 'update'])->name('admin.deportes.update');
    Route::delete('/deportes/{deporte}', [AdminDeporteController::class, 'destroy'])->name('admin.deportes.destroy');

    Route::get('/superficie', [AdminSuperficieController::class, 'index'])->name('admin.superficie.index');
    Route::get('/superficie/create', [AdminSuperficieController::class, 'create'])->name('admin.superficie.create');
    Route::post('/superficie', [AdminSuperficieController::class, 'store'])->name('admin.superficie.store');
    Route::get('/superficie/{superficie}/edit', [AdminSuperficieController::class, 'edit'])->name('admin.superficie.edit');
    Route::put('/superficie/{superficie}', [AdminSuperficieController::class, 'update'])->name('admin.superficie.update');
    Route::delete('/superficie/{superficie}', [AdminSuperficieController::class, 'destroy'])->name('admin.superficie.destroy');

    Route::get('/pista', [AdminPistaController::class, 'index'])->name('admin.pista.index');
    Route::get('/pista/create', [AdminPistaController::class, 'create'])->name('admin.pista.create');
    Route::post('/pista', [AdminPistaController::class, 'store'])->name('admin.pista.store');
    Route::get('/pista/{pista}/edit', [AdminPistaController::class, 'edit'])->name('admin.pista.edit');
    Route::put('/pista/{pista}', [AdminPistaController::class, 'update'])->name('admin.pista.update');
    Route::delete('/pista/{pista}', [AdminPistaController::class, 'destroy'])->name('admin.pista.destroy');
});

Route::post('contactanos', ContactanosController::class)
    ->middleware(['auth', 'throttle:3,1'])
    ->name('contactanos');

require __DIR__.'/auth.php';
