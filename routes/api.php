<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('services', [ServiceController::class, 'create'])->name('services.create');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'delete'])->name('services.delete');

    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookingsbyuser/{user}', [BookingController::class, 'listByUser'])->name('bookings.listByUser');
    Route::post('bookings', [BookingController::class, 'create'])->name('bookings.create');
    Route::put('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
});