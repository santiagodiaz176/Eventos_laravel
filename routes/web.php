<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UsuarioController;

/*
| Rutas para Visitantes (sin iniciar sesión)
*/

Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/somos', function () {
    return view('somos');
})->name('somos');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

// Contacto visitante
Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');

// Registro y Login
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.store');

/*
| Rutas del Usuario Registrado (requiere login)
*/

Route::middleware(['auth'])->group(function () {

    // Página principal del usuario
    Route::get('/usuario', function () {
        return view('user/index_user');
    })->name('usuario');

    // Servicios del usuario
    Route::get('/usuario/servicios', function () {
        return view('user/servicios_user');
    })->name('usuario.servicios');

    // Somos del usuario
    Route::get('/usuario/somos', function () {
        return view('user/somos_users');
    })->name('usuario.somos');

    Route::get('/usuario/eventos', [EventoController::class, 'index'])
    ->name('eventos.index')
    ->middleware('auth');

    // Contacto del usuario
    Route::get('/usuario/contacto', [ContactController::class, 'index'])
        ->name('usuario.contacto');

    Route::post('/usuario/contacto', [ContactController::class, 'submit'])
        ->name('usuario.contact.submit');

    // Mostrar todos los eventos del usuario
    Route::get('/usuario/eventos', [EventoController::class, 'index'])
        ->name('eventos.index');

    // Formulario para crear un evento
    Route::get('/usuario/eventos/create', [EventoController::class, 'create'])
        ->name('eventos.create');

    // Guardar el evento en la base de datos
    Route::post('/usuario/eventos', [EventoController::class, 'store'])
        ->name('eventos.store');

    Route::get('/usuario/citas/create/{id_evento}', [CitaController::class, 'create'])
        ->name('citas.create');

    Route::post('/reservar-cita', [CitaController::class, 'store'])
    ->name('reserva.cita');
});


// Rutas del Administrador (requiere login y rol de admin)
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index');

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])
    ->name('usuarios.create');

    Route::post('/usuarios', [UsuarioController::class, 'store'])
    ->name('usuarios.store');

    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])
    ->name('usuarios.edit');

    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])
    ->name('usuarios.update');

    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])
    ->name('usuarios.destroy');
});


/*
| Logout (solo redirección)
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('inicio');
})->name('logout');


/*
|Newsletter
*/

Route::post('/newsletter/subscribe', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
    ]);

    return back()->with('success', '¡Gracias por suscribirte a nuestro boletín!');
    
})->name('newsletter.subscribe');
