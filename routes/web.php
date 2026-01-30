<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// dashboards
Route::get('/dashboard/chercheur', function () {
    return view('dashboard.chercheur');
})->middleware(['auth'])->name('chercheur');

Route::get('/dashboard/recruteur', function () {
    return view('dashboard.recruteur');
})->middleware(['auth'])->name('recruteur');

// profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// profile
Route::get('/profile/{id}', [ProfileController::class,'show'])->name('profile.show');

Route::get('/search', [SearchController::class,'search'])->name('search');


require __DIR__.'/auth.php';
