<?php

use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/roles')->group(function () {
    Route::post('/add', [RolesController::class, 'add'])->name('roleAdd');
    Route::post('/edit', [RolesController::class, 'edit'])->name('roleEdit');
    Route::post('/delete', [RolesController::class, 'delete'])->name('roleDelete');
});
