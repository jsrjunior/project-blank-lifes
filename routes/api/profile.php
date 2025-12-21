<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Retorna dados do usuário logado
Route::get('/user', [ProfileController::class, 'show'])->name('api.profile.show');

// Atualizar perfil
Route::put('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
