<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderFeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectTemplateController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/templates', [ProjectTemplateController::class, 'index'])->name('templates.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/deliverables/{deliverable}/download', [OrderController::class, 'download'])
        ->name('orders.deliverables.download');
    Route::get('/orders/{order}/feedback', [OrderFeedbackController::class, 'create'])->name('orders.feedback.create');
    Route::post('/orders/{order}/feedback', [OrderFeedbackController::class, 'store'])->name('orders.feedback.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
