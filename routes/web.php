<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;

Route::view('/', 'inicio');
Route::view('/nosotros', 'nosotros');
Route::view('/contacto', 'contacto');
Route::get('/catalogo', [ProductoController::class, 'catalogo']);

Route::get('/detalle/{id}', [ProductoController::class, 'detalle']);
Route::get('/carrito', [CarritoController::class, 'index']);
Route::post('/carrito/agregar', [CarritoController::class, 'agregar']);
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar']);
Route::get('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar']);
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar']);

//autenticacion
Route::get('/registro', [AuthController::class, 'showRegistro']);
Route::post('/registro', [AuthController::class, 'registro']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/perfil', [AuthController::class, 'perfil']);

Route::post('/perfil/update', [AuthController::class, 'updateProfile']);

Route::post('/perfil/password', [AuthController::class, 'changePassword']);

Route::post('/perfil/imagen', [AuthController::class, 'updateImage']);


// pedidos
Route::post('/pedido/crear', [PedidoController::class, 'crear']);

Route::get('/pedidos', [PedidoController::class, 'index']);

Route::get('/pedido/{id}', [PedidoController::class, 'detalle']);

Route::get('/pedido/cancelar/{id}', [PedidoController::class, 'cancelar']);


Route::get('/pedido/pagar/{id}', [PagoController::class, 'pagar']);

Route::get('/paypal/success', [PagoController::class, 'success']);

Route::get('/paypal/cancel', [PagoController::class, 'cancel']);