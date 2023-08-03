<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

Route::get('/pemasok', [PemasokController::class, 'index']);
Route::post('/pemasok', [PemasokController::class, 'store']);
Route::get('/pemasok/{id}', [PemasokController::class, 'show']);
Route::put('/pemasok/{id}', [PemasokController::class, 'update']);
Route::delete('/pemasok/{id}', [PemasokController::class, 'destroy']);
Route::get('/pemasok/{id}/barang', [PemasokController::class, 'barang']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::put('/produk/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);
