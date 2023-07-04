<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('dashboard', [DashboardController::class, 'show'])->middleware(['auth'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/thankyou', function (){
  return Inertia::render('Auth/Thankyou');
})->name('thankyou');

Route::get('/users', function (){
  return Inertia::render('Users/Index', [
    'name' => 'Faiz',
    'company' => 'ITK',
  ]);
});


require __DIR__.'/auth.php';
