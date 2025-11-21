<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Página principal
Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/registro', function () {
    return view('auth.register');
})->name('registro');

// Página "Acerca de nosotros"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Página "Quienes Somos" 
Route::get('/somos', function () {
    return view('somos');
})->name('somos');

// Página de Servicios
Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

// Página de contacto → **ahora con controlador**
Route::get('/contacto', [ContactController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactController::class, 'submit'])->name('contact.submit');

// Página de registro de usuarios
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Página de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para el formulario del newsletter (pie de página)
Route::post('/newsletter/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email'
    ]);

    return back()->with('success', '¡Gracias por suscribirte a nuestro boletín!');
})->name('newsletter.subscribe');
