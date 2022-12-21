<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function isManager()
{
    return Auth::user()->role->name === 'manager';
}

Route::middleware('auth')->group(function () {
    Route::get('/')->middleware('role:unknown');

    Route::middleware('role:client')->group(function () {
        Route::get('/client', function () { return view('client'); })->name('client');
        Route::resource('/applications', ApplicationController::class);
    });

    Route::middleware('role:manager')->group(function () {
        Route::get('/manager', function () {
            $apps = Application::latest()->paginate(3);
            return view('manager')->with(['applications' => $apps]);
        })->name('manager');
        Route::get('/answers/{application}', [AnswerController::class, 'create'])->name('answers.create');
        Route::post('/answers/{application}', [AnswerController::class, 'store'])->name('answers.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
