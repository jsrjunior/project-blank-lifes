<?php

use App\Http\Controllers\Admin\AddressTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('address_types')->middleware(['auth:users'])->group(function () {
    Route::get('/', [AddressTypeController::class, 'index'])->name('web.admin.address_types.index');
    Route::get('create', [AddressTypeController::class, 'create'])->name('web.admin.address_types.create');
    Route::post('/', [AddressTypeController::class, 'store'])->name('web.admin.address_types.store');
    Route::get('{id}/edit', [AddressTypeController::class, 'edit'])->name('web.admin.address_types.edit');
    Route::put('{id}', [AddressTypeController::class, 'update'])->name('web.admin.address_types.update');
    Route::delete('{id}', [AddressTypeController::class, 'delete'])->name('web.admin.address_types.delete');
    Route::put('{id}/restore', [AddressTypeController::class, 'restore'])->name('web.admin.address_types.restore');
});