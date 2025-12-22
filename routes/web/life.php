<?php

use App\Http\Controllers\Admin\LifeController;
use Illuminate\Support\Facades\Route;

Route::prefix('lives')->middleware(['auth:users'])->group(function () {
    Route::get('/', [LifeController::class, 'index'])->name('web.admin.lives.index');
    Route::get('create', [LifeController::class, 'create'])->name('web.admin.lives.create');
    Route::post('/', [LifeController::class, 'store'])->name('web.admin.lives.store');
    Route::get('{id}/edit', [LifeController::class, 'edit'])->name('web.admin.lives.edit');
    Route::put('{id}', [LifeController::class, 'update'])->name('web.admin.lives.update');
    Route::delete('{id}', [LifeController::class, 'delete'])->name('web.admin.lives.delete');
    Route::put('{id}/restore', [LifeController::class, 'restore'])->name('web.admin.lives.restore');
});