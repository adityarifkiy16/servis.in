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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    Route::middleware(['permission:management_users'])->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
            Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
            Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::put('/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
        });
    });


    Route::middleware(['permission:management_roles'])->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
            Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
            Route::get('/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
            Route::put('/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
            Route::delete('/delete/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.delete');
        });
    });


    Route::middleware(['permission:management_roles'])->group(function () {
        Route::prefix('permission')->group(function () {
            Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
            Route::get('/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permission.create');
            Route::post('/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
            Route::get('/edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
            Route::put('/update/{id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
            Route::delete('/delete/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.delete');
        });
    });


    Route::middleware(['permission:management_product'])->group(function () {
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::resource('jenises', App\Http\Controllers\JenisController::class);
    });

    Route::middleware(['permission:management_departement'])->group(function () {
        Route::resource('departments', App\Http\Controllers\DepartementController::class);
    });

    Route::middleware(['permission:management_service'])->group(function () {
        Route::resource('servicetype', App\Http\Controllers\ServiceTypeController::class);
        Route::resource('service', App\Http\Controllers\ServiceController::class);
    });

    Route::middleware(['permission:download_report'])->group(function () {
        Route::prefix('reports')->group(function () {
            Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
            Route::get('/download', [App\Http\Controllers\ReportController::class, 'download'])->name('report.download');
        });
    });


    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
