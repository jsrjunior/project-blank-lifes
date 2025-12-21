<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Profile Routes (Web)
|--------------------------------------------------------------------------
|
| Rotas web relacionadas ao Profile.
| Todas protegidas pelo middleware auth.
|
*/

Route::middleware('users')->group(function () {

    // Editar perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Atualizar perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Deletar perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Dashboard (mantendo como estava)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Página inicial
Route::get('/', function () {
    return view('welcome');
});
