<?php
use App\Http\Controllers\Api\PasswordResetController;

Route::prefix('password')->group(function () {
    // Solicitar enlace de recuperación
    Route::post('/forgot', [PasswordResetController::class, 'sendResetLink']);
    
    // Resetear la contraseña
    Route::post('/reset', [PasswordResetController::class, 'resetPassword']);
    
    // Verificar token (opcional)
    Route::post('/verify-token', [PasswordResetController::class, 'verifyToken']);
});

?>