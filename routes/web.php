<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("admin")->middleware(["auth"])->group(function (){
    
    Route::get('/', function () {
        return view('admin.index');
    })->name("admin_inicio");

    Route::resource("/categoria", CategoriaController::class)->middleware(["role:cajero"]);
    Route::resource("/producto", ProductoController::class);
    Route::resource("/cliente", ClienteController::class)->middleware("role:cajero");
    Route::resource("/pedido", PedidoController::class)->middleware("role:cajero");
    Route::resource("/usuario", UsuarioController::class)->middleware("role:admin");
    Route::resource("/role", RoleController::class)->middleware("role:admin");
});



//Route::get("/qr", [CategoriaController::class, "generarQR"]);


Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
