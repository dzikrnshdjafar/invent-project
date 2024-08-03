<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);

    Route::resource('items', ItemController::class)->middleware('role:Admin');
    Route::resource('rooms', RoomController::class)->middleware('role:Admin|Pengelola');

    Route::resource('loans', LoanController::class);
    Route::put('loans/{loan}/return', [LoanController::class, 'returnItem'])->name('loans.returnItem')->middleware('role:Admin');
});



require __DIR__ . '/auth.php';
