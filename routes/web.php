<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CitaAdminController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\Admin\HorarioAtencionController;

/*
| Rutas específicas PRIMERO
*/
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/somos', fn() => view('somos'))->name('somos');
Route::get('/servicios', fn() => view('servicios'))->name('servicios');

// Contacto visitante
Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');

// Registro y Login
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

/*
| RUTAS DE RECUPERACIÓN DE CONTRASEÑA
*/
Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

/*
| Rutas del Usuario Registrado (requiere login)
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/usuario', fn() => view('user/index_user'))->name('usuario');
    Route::get('/usuario/servicios', fn() => view('user/servicios_user'))->name('usuario.servicios');
    Route::get('/usuario/somos', fn() => view('user/somos_users'))->name('usuario.somos');

    // Eventos usuario
    Route::get('/usuario/eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('/usuario/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/usuario/eventos', [EventoController::class, 'store'])->name('eventos.store');

    // Citas usuario
    Route::get('/usuario/citas/create/{id_evento}', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/reservar-cita', [CitaController::class, 'store'])->name('reserva.cita');
    Route::get('/usuario/citas/{id}/estado', [CitaController::class, 'estado'])->name('citas.estado');

    // Contacto usuario
    Route::get('/usuario/contacto', [ContactController::class, 'index'])->name('usuario.contacto');
    Route::post('/usuario/contacto', [ContactController::class, 'submit'])->name('usuario.contact.submit');

    Route::get('/citas/horas', [CitaController::class, 'horasDisponibles'])->name('citas.horas');
});

/*
| Rutas del Administrador (requiere login y rol de admin)
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Usuario CRUD
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

     // SERVICIOS
   // SERVICIOS
Route::prefix('servicios')->name('admin.servicios.')->group(function () {

    Route::get('/crear/{id_cita}', [App\Http\Controllers\Admin\ServiciosController::class, 'crear'])
        ->name('crear');
    
    Route::post('/store', [App\Http\Controllers\Admin\ServiciosController::class, 'store'])
        ->name('store');
    
    Route::get('/editar/{id_servicio_contratado}', [App\Http\Controllers\Admin\ServiciosController::class, 'editar'])
        ->name('editar');
    
    Route::put('/update/{id_servicio_contratado}', [App\Http\Controllers\Admin\ServiciosController::class, 'update'])
        ->name('update');
    
    Route::put('/enviar/{id_servicio_contratado}', [App\Http\Controllers\Admin\ServiciosController::class, 'enviar'])
        ->name('enviar');
});


    // Citas CRUD
    Route::get('/citas', [CitaAdminController::class, 'index'])->name('admin.citas.index');
    Route::post('/citas', [CitaAdminController::class, 'store'])->name('admin.citas.store');
    Route::get('/citas/{id}/edit', [CitaAdminController::class, 'edit'])->name('admin.citas.edit');
    Route::put('/citas/{id}', [CitaAdminController::class, 'update'])->name('admin.citas.update');
    Route::delete('/citas/{id}', [CitaAdminController::class, 'destroy'])->name('admin.citas.destroy');

    // Eventos admin
    Route::get('/eventos/{id_cita}/editar', [EventoController::class, 'editarPorAdmin'])->name('admin.eventos.editar');
    Route::put('/eventos/{id_evento}', [EventoController::class, 'updatePorAdmin'])->name('admin.eventos.update');

    
    // Suscripciones CRUD
    Route::get('/suscripciones/create', [SuscripcionController::class, 'createAdmin'])->name('admin.suscripciones.create');
    Route::post('/suscripciones', [SuscripcionController::class, 'storeAdmin'])->name('admin.suscripciones.store');
    Route::get('/suscripciones/{id}/edit', [SuscripcionController::class, 'editAdmin'])->name('admin.suscripciones.editar');
    Route::put('/suscripciones/{id}', [SuscripcionController::class, 'update'])->name('admin.suscripciones.update');
    Route::delete('/suscripciones/{id}', [SuscripcionController::class, 'destroy'])->name('admin.suscripciones.destroy');
    Route::put('/suscripciones/{id}/toggle', [SuscripcionController::class, 'toggle'])->name('admin.suscripciones.toggle');

    // Horarios de atención CRUD
    Route::get('/admin/horarios', [HorarioAtencionController::class, 'index'])->name('admin.horarios');
    Route::post('/admin/horarios', [HorarioAtencionController::class, 'store'])->name('admin.horarios.store');
});

/*
| Logout
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('inicio');
})->name('logout');

/*
| Newsletter
*/
Route::post('/newsletter/subscribe', [SuscripcionController::class, 'store'])->name('newsletter.subscribe');

/*
| RUTA RAÍZ - SIEMPRE AL FINAL
*/
Route::get('/', fn() => view('index'))->name('inicio');
