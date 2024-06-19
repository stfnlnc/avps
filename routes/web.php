<?php

use App\Http\Controllers\BicycleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//
Route::get('/', function () {
    return view('main.index');
})->name('index');


Route::middleware(['role:admin|editor'])->prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class)->except([
        'show'
    ]);
    Route::resource('bicycle', BicycleController::class);
    Route::resource('location', LocationController::class);
    Route::resource('repair', RepairController::class);
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::middleware(['auth'])->get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware(['auth'])->patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware(['auth'])->delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';


