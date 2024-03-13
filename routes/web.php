<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

//index
Route::get('/', [CrudController::class, "index"])->name("crud.index");

//ruta agregar producto
Route::post('/agregar-producto', [CrudController::class, "create"])->name("crud.create");

Route::post('/modificar-producto', [CrudController::class, "update"])->name("crud.update");

Route::get('/eliminar-producto-{id}', [CrudController::class, "delete"])->name("crud.delete");
