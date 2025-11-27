<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservaController;

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
        return view('user/servicios.user');
    })->name('usuario.servicios');

    // Somos del usuario
    Route::get('/usuario/somos', function () {
        return view('user/somos_users');
    })->name('usuario.somos');

    // Contacto del usuario
    Route::get('/usuario/contacto', [ContactController::class, 'index'])
        ->name('usuario.contacto');

    Route::post('/usuario/contacto', [ContactController::class, 'submit'])
        ->name('usuario.contact.submit');

    Route::post('/usuario/reserva', [ReservaController::class, 'store'])
        ->name('reserva.store');
});



/*
| Logout (solo redirección)
*/
Route::get('/logout', function () {
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
