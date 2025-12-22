<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Models\Rental;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirect the gear list so it's public (guests can see gear, but not rent it)
Route::get('/items', [RentalController::class, 'index'])->name('items.index');

use Illuminate\Support\Facades\Auth; // Add this at the top

Route::get('/dashboard', function () {
    $bookings = Rental::where('user_id', Auth::id()) // Use Auth::id()
        ->with('item') 
        ->latest()
        ->get();

    return view('dashboard', [
        'bookings' => $bookings
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// All rental actions go inside this group to prevent "user_id is null" errors
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rental Gear Routes
    Route::post('/rent', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/my-bookings', [RentalController::class, 'myBookings'])->name('bookings.index');
});

require __DIR__.'/auth.php';