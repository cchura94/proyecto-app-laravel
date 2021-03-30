<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("admin")->group(function (){
    
    Route::get('/', function () {
        return view('admin.index');
    })->name("admin_inicio");

    Route::resource("/categoria", CategoriaController::class);
    Route::resource("/producto", ProductoController::class);
    Route::resource("/cliente", ClienteController::class);
    Route::resource("/pedido", PedidoController::class);
    Route::resource("/usuario", UsuarioController::class);
    Route::resource("/role", RoleController::class);
});



//Route::get("/qr", [CategoriaController::class, "generarQR"]);

