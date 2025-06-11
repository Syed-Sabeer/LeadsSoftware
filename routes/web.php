<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (Guest only)
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login-attempt', [LoginController::class, 'loginAttempt'])->name('login.attempt');
});

// Logout Route
Route::post('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Logged out successfully');
})->name('logout');

// Admin Panel Routes (Authentication required + Admin role)
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Leads Management
    Route::prefix('admin/leads')->name('admin.leads.')->group(function () {
        Route::get('/', [LeadsController::class, 'index'])->name('index');
        Route::get('/create', [LeadsController::class, 'create'])->name('create');
        Route::post('/', [LeadsController::class, 'store'])->name('store');
        Route::get('/{lead}', [LeadsController::class, 'show'])->name('show');
        Route::get('/{lead}/edit', [LeadsController::class, 'edit'])->name('edit');
        Route::put('/{lead}', [LeadsController::class, 'update'])->name('update');
        Route::delete('/{lead}', [LeadsController::class, 'destroy'])->name('destroy');
    });
});
