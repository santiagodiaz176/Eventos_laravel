<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

/*
| Rutas del Usuario Registrado (requiere login)
*/

Route::middleware(['auth'])->group(function () {

    // Página principal del usuario
    Route::get('/usuario', function () {
        return view('user.index_user');
    })->name('usuario');

    // Servicios del usuario
    Route::get('/usuario/servicios', function () {
        return view('user.servicios_user');
    })->name('usuario.servicios');

    // Somos del usuario
    Route::get('/usuario/somos', function () {
        return view('user.somos_Users');
    })->name('usuario.somos');

    // Contacto del usuario
    Route::get('/usuario/contacto', [ContactController::class, 'index'])
        ->name('usuario.contacto');

    Route::post('/usuario/contacto', [ContactController::class, 'submit'])
        ->name('usuario.contact.submit');
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
