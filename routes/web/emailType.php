<?php

use App\Http\Controllers\Admin\EmailTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('email_types')->middleware(['auth:users'])->group(function () {
    Route::get('/', [EmailTypeController::class, 'index'])->name('web.admin.email_types.index');
    Route::get('create', [EmailTypeController::class, 'create'])->name('web.admin.email_types.create');
    Route::post('/', [EmailTypeController::class, 'store'])->name('web.admin.email_types.store');
    Route::get('{id}/edit', [EmailTypeController::class, 'edit'])->name('web.admin.email_types.edit');
    Route::put('{id}', [EmailTypeController::class, 'update'])->name('web.admin.email_types.update');
    Route::delete('{id}', [EmailTypeController::class, 'delete'])->name('web.admin.email_types.delete');
    Route::put('{id}/restore', [EmailTypeController::class, 'restore'])->name('web.admin.email_types.restore');
});