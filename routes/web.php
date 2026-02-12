<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    if ($user && $user->role === 'recruteur') {
        return redirect()->route('recruteur');
    }
    return redirect()->route('chercheur');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/chercheur', function () {
    return view('dashboard.chercheur');
})->middleware(['auth'])->name('chercheur');

Route::get('/dashboard/recruteur', function () {
    return view('dashboard.recruteur');
})->middleware(['auth'])->name('recruteur');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/cv', [CvController::class, 'index'])->name('cv.show');
    Route::get('/cv/create', [CvController::class, 'create'])->name('cv.create');
    Route::post('/cv', [CvController::class, 'store'])->name('cv.store');
});

Route::get('/offres', [JobOfferController::class, 'index'])->name('job.offers');
Route::get('/offres/{jobOffer}', [JobOfferController::class, 'show'])->name('job.show');

Route::middleware(['auth', 'chercheur'])->group(function () {
    Route::post('/offres/{jobOffer}/apply', [JobOfferController::class, 'apply'])->name('job.apply');
});

Route::middleware(['auth', 'recruteur'])->group(function () {
    Route::get('/offres-create', [JobOfferController::class, 'create'])->name('job.create');
    Route::post('/offres', [JobOfferController::class, 'store'])->name('job.store');
    Route::get('/mes-offres', [JobOfferController::class, 'myOffers'])->name('job.my_offers');
    Route::post('/offres/{jobOffer}/toggle-close', [JobOfferController::class, 'toggleClose'])->name('job.toggle_close');
});

require __DIR__.'/auth.php';
