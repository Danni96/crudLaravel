<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/', [CrudController::class, "index"])->name("crud.index");
    Route::post('/agregar-producto', [CrudController::class, "create"])->name("crud.create");
    Route::post('/modificar-producto', [CrudController::class, "update"])->name("crud.update");
    Route::get('/eliminar-producto-{id}', [CrudController::class, "delete"])->name("crud.delete");
    Route::get('/home', [CrudController::class, "index"])->name("crud.index");
});

// Rutas para autenticación
Auth::routes();
