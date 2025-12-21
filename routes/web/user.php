<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->middleware(['auth:users'])->group(function () {
    // CRUD geral
    Route::get('/', [UserController::class, 'index'])->name('web.admin.users.index');
    Route::get('create', [UserController::class, 'create'])->name('web.admin.users.create');
    Route::post('/', [UserController::class, 'store'])->name('web.admin.users.store');
    Route::get('{id}/edit', [UserController::class, 'edit'])->name('web.admin.users.edit');
    Route::put('{id}', [UserController::class, 'update'])->name('web.admin.users.update');
    Route::delete('{id}', [UserController::class, 'delete'])->name('web.admin.users.delete');
    Route::put('{id}/restore', [UserController::class, 'restore'])->name('web.admin.users.restore');

    // Import/export/download
    // Route::get('download', [UserController::class, 'downloadSynchronous'])->name('web.admin.users.download');
    // Route::get('import', [UserController::class, 'import'])->name('web.admin.users.import');
    // Route::post('sendImport', [UserController::class, 'sendImport'])->name('web.admin.users.send-import');
});
