<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function isManager() {
    return Auth::user()->role->name === 'manager';
}

Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'main']);
    Route::get('/manager', [MainController::class, 'manager'])->name('manager');
    Route::get('/client', [MainController::class, 'client'])->name('client');
    Route::resource('/applications', ApplicationController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
