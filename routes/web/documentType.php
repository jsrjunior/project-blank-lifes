<?php

use App\Http\Controllers\Admin\DocumentTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('document_types')->middleware(['auth:users'])->group(function () {
    Route::get('/', [DocumentTypeController::class, 'index'])->name('web.admin.document_types.index');
    Route::get('create', [DocumentTypeController::class, 'create'])->name('web.admin.document_types.create');
    Route::post('/', [DocumentTypeController::class, 'store'])->name('web.admin.document_types.store');
    Route::get('{id}/edit', [DocumentTypeController::class, 'edit'])->name('web.admin.document_types.edit');
    Route::put('{id}', [DocumentTypeController::class, 'update'])->name('web.admin.document_types.update');
    Route::delete('{id}', [DocumentTypeController::class, 'delete'])->name('web.admin.document_types.delete');
    Route::put('{id}/restore', [DocumentTypeController::class, 'restore'])->name('web.admin.document_types.restore');
});