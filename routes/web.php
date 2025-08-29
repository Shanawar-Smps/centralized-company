<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard should point to CompanyController@search
// Dashboard (for logged-in users)
Route::get('/dashboard', [CompanyController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Company Search (public or protected? depends on your case)
Route::get('/companies/search', [CompanyController::class, 'search'])
    ->name('companies.search');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company routes
    Route::get('/companies/{country}/{id}', [CompanyController::class, 'show'])->name('companies.show');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');
});

require __DIR__ . '/auth.php';
