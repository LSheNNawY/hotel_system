<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReceptionistsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/admin/')
    ->name('admin.')
    ->middleware(['role:admin|manager'])
    ->group(function () {
        Route::resource('receptionists', ReceptionistsController::class);
        Route::get('rooms', [RoomsController::class, 'index'])->name('rooms');
        Route::post('rooms', [RoomsController::class, 'store'])->name('rooms.create');
        Route::delete('rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.delete');
        // rooms crud
        Route::resource('rooms', RoomsController::class);
        // floors crud
        Route::resource('floors', FloorsController::class);
        // reservations
        Route::resource('reservations', ReservationsController::class);
        // reservations approval ajax
        Route::put("/ajax/{case}/res/{id}", [ReservationController::class, 'approve']);
});




