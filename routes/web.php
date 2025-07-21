<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes d'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/status', [AuthController::class, 'showStatus'])->name('status');

// Routes d'administration (protégées par middleware)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/approve/{id}', [AdminController::class, 'approveRequest'])->name('approve');
    Route::post('/reject/{id}', [AdminController::class, 'rejectRequest'])->name('reject');
    Route::get('/user/{id}', [AdminController::class, 'showUserDetails'])->name('user.details');
});

// Routes pour entrepreneurs (protégées par middleware)
Route::middleware(['auth', 'role:entrepreneur_approuve'])->prefix('entrepreneur')->name('entrepreneur.')->group(function () {
    Route::get('/dashboard', function () {
        return view('entrepreneur.dashboard');
    })->name('dashboard');
});
