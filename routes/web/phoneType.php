<?php

use App\Http\Controllers\Admin\PhoneTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('phone_types')->middleware(['auth:users'])->group(function () {
    Route::get('/', [PhoneTypeController::class, 'index'])->name('web.admin.phone_types.index');
    Route::get('create', [PhoneTypeController::class, 'create'])->name('web.admin.phone_types.create');
    Route::post('/', [PhoneTypeController::class, 'store'])->name('web.admin.phone_types.store');
    Route::get('{id}/edit', [PhoneTypeController::class, 'edit'])->name('web.admin.phone_types.edit');
    Route::put('{id}', [PhoneTypeController::class, 'update'])->name('web.admin.phone_types.update');
    Route::delete('{id}', [PhoneTypeController::class, 'delete'])->name('web.admin.phone_types.delete');
    Route::put('{id}/restore', [PhoneTypeController::class, 'restore'])->name('web.admin.phone_types.restore');
});