<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Login
Route::post('/login', [UserController::class, 'login']);

// Usuarios.
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

// Unidades.
Route::get('/units', [UnitController::class, 'index']);
Route::get('/units/{id}', [UnitController::class, 'show']);
Route::post('/units', [UnitController::class, 'store']);
Route::put('/units/{id}', [UnitController::class, 'update']);
Route::delete('/units/{id}', [UnitController::class, 'delete']);

// Productos
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

// Inventarios
Route::get('/inventories', [InventoryController::class, 'index']);
Route::get('/inventories/{productId}', [InventoryController::class, 'show']);
Route::post('/add-entry', [InventoryController::class, 'handleInventoryEntry']);
Route::post('/add-exit', [InventoryController::class, 'handleInventoryExit']);

// Depósitos
Route::get('/deposits', [DepositController::class, 'index']);
Route::get('/deposits/{id}', [DepositController::class, 'show']);
Route::post('/deposits', [DepositController::class, 'store']);
Route::put('/deposits/{id}', [DepositController::class, 'update']);
Route::delete('/deposits/{id}', [DepositController::class, 'delete']);

// Órdenes
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/newest', [OrderController::class, 'getAllNewOrders']);
Route::get('/orders/ready-to-deliver', [OrderController::class, 'getAllOrdersReadyToDeliver']);
Route::post('/orders/{order}/preparing', [OrderController::class, 'markAsPreparing']);
Route::post('/orders/{order}/ready-to-deliver', [OrderController::class, 'markAsReadyToDeliver']);

Route::post('/orders', [OrderController::class, 'createDummyOrder']);
