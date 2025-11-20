<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Página principal
Route::get('/', function () {
    return view('index');
})->name('index');

// Página "Acerca de nosotros"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Página "Quienes Somos" 
Route::get('/quienes-somos', function () {
    return view('somos');
})->name('quienes-somos');

// Página "Servicios"
Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

// Página de registro de usuarios
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Página de inicio de sesión (opcional, pero útil)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para el formulario del newsletter (pie de página)
Route::post('/newsletter/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email'
    ]);

    // Aquí puedes guardar el correo en la base de datos o en un archivo si deseas
    // Por ahora solo devolvemos un mensaje de éxito
    return back()->with('success', '¡Gracias por suscribirte a nuestro boletín!');
})->name('newsletter.subscribe');
