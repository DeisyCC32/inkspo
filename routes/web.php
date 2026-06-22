<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistDashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArtistOrderController;

Route::get(
    '/',
    [MarketplaceController::class, 'index']
)->middleware('auth')
 ->name('home');

Route::get(
    '/dashboard',
    [ArtistDashboardController::class, 'index']
)->middleware(['auth', 'verified'])
 ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/artist/dashboard', [ArtistDashboardController::class, 'index'])
    ->middleware(['auth', 'artist'])
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
    ->middleware('auth','artist')
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

Route::get(
    '/artist/{user}',
    [ArtistDashboardController::class, 'profile']
)->name('artist.profile');

Route::post(
    '/artist/orders/{order}/upload-result',
    [ArtistOrderController::class, 'uploadResult']
)->name('orders.uploadResult', 'artist');

Route::post(
    '/orders/{order}/review',
    [OrderController::class, 'submitReview']
)->middleware('auth')
 ->name('orders.review');

 Route::patch(
    '/orders/{order}/pay',
    [OrderController::class,'pay']
)->name('orders.pay');