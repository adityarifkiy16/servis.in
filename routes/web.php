<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::middleware(['guest'])->prefix('user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
});
