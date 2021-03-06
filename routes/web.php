<?php

use App\Http\Controllers\FloorsController;
use App\Http\Controllers\manager\ManagersFloorsController;
use App\Http\Controllers\manager\ManagersRoomsController;
use App\Http\Controllers\manager\ManagersReceptionistsController;
use App\Http\Controllers\manager\ManagersManagersController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReceptionistsController;
use App\Http\Controllers\ManagersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\receptionist\ClientController;


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

// Route::get('/admin/users', [UserController::class, 'index'])->name('users');

// Route::get('/admin/users', [UserController::class, 'index'])->name('users');

Route::prefix('/admin/')
    ->name('admin.')
    ->middleware(['role:admin', 'auth'])
    ->group(function () {
        // receptionist crud
        Route::resource('receptionists', ReceptionistsController::class);
       // manager crud
        Route::resource('managers', ManagersController::class);
        // user crud
        Route::resource('users', UserController::class);
        // rooms crud
        Route::resource('rooms', RoomsController::class);
        // floors crud
        Route::resource('floors', FloorsController::class);
        // reservations
        Route::resource('reservations', ReservationController::class);
        // reservations approval ajax
        Route::put("/ajax/{case}/res/{id}", [ReservationController::class, 'approve']);


});

Route::prefix('/manager/')
    ->name('manager.')
    ->middleware(['role:manager', 'auth'])
    ->group(function () {
        // floors crud
        Route::resource('floors', ManagersFloorsController::class);
        Route::resource('rooms', ManagersRoomsController::class);
        Route::resource('receptionists', ManagersReceptionistsController::class);
        Route::resource('managers', ManagersManagersController::class);



});
Route::prefix('/receptionist/')
    ->name('receptionist.')
    ->middleware(['role:receptionist', 'auth'])
    ->group(function () {
        Route::get("clients/approved", [ClientController::class, 'show'])->name('clients.approved');
});

Route::prefix('/receptionist/')
    ->name('receptionist.')
    ->middleware(['role:receptionist', 'auth'])
    ->group(function () {
        Route::resource('clients', ClientController::class);
        // Route::get("clients/approved", [ClientController::class, 'show'])->name('clients.approved');
});






