<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function isManager() {
    return Auth::user()->role->name === 'manager';
}

function isReqUserManager(Request $request) {
    return $request->user()->role->name === 'manager';
}

Route::get('/', function (Request $request) {
    return isReqUserManager($request) ? redirect('manager') : redirect('client');
})->middleware('auth');

Route::get('/manager', function (Request $request) {
    return isReqUserManager($request) ? view('manager') : redirect('client');
})->middleware(['auth', 'verified'])->name('manager');

Route::get('/client', function (Request $request) {
    return isReqUserManager($request) ? redirect('manager') : view('client');
})->middleware(['auth', 'verified'])->name('client');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
