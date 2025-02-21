<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TicketController;

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


Route::get('/dashboard', function () {//dyal home
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('tickets', TicketController::class);
        Route::resource('users', UserController::class);
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
        Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');


    });

    // User routes
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {

        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');


    });

    // Agent routes
    Route::middleware(['role:agent'])->prefix('agent')->name('agent.')->group(function () {
            Route::get('/dashboard', [AgentController::class, 'index'])->name('dashboard');
        // Other user routes...
    });


});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

require __DIR__.'/auth.php';
