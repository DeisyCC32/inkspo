<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistDashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArtistOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/artist/dashboard', [ArtistDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('artist.dashboard');

Route::resource('services', ServiceController::class)
    ->middleware('auth');

Route::get('/marketplace', [MarketplaceController::class, 'index'])
    ->middleware('auth')
    ->name('marketplace');

Route::post('/services/{service}/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('orders.store');

Route::get('/artist/orders', [ArtistOrderController::class, 'index'])
    ->middleware('auth')
    ->name('artist.orders');

Route::get('/services/{service}/request', [OrderController::class, 'create'])
    ->middleware('auth')
    ->name('orders.create');

Route::patch('/orders/{order}/accept', [ArtistOrderController::class, 'accept'])
    ->middleware('auth')
    ->name('orders.accept');

Route::patch('/orders/{order}/reject', [ArtistOrderController::class, 'reject'])
    ->middleware('auth')
    ->name('orders.reject');

Route::get('/my-orders', [OrderController::class, 'myOrders'])
    ->middleware('auth')
    ->name('orders.my');
require __DIR__.'/auth.php';