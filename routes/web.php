<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function isManager() { return Auth::user()->role->name === 'manager'; }

Route::middleware('auth')->group(function () {
    Route::get('/')->middleware('role:unknown');   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:manager', 'auth'])->group(function () {
    Route::get('/manager', [MainController::class, 'manager'])->name('manager');
    Route::get('/answers/{application}', [AnswerController::class, 'create'])->name('answers.create');
    Route::post('/answers/{application}', [AnswerController::class, 'store'])->name('answers.store');
});

Route::middleware(['role:client', 'auth'])->group(function () {
    Route::get('/client', [MainController::class, 'client'])->name('client');
    Route::resource('/applications', ApplicationController::class);
});

require __DIR__ . '/auth.php';
