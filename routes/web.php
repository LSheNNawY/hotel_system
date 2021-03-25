<?php

use App\Http\Controllers\RoomsController;
use App\Http\Controllers\FloorsController;
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

          // rooms crud
       Route::resource('rooms', RoomsController::class);

       Route::resource('floors', FloorsController::class);


      /*  Route::get('floors', [FloorsController::class, 'index'])->name('floors');
        Route::post('floors', [FloorsController::class, 'store'])->name('floors.create');
        Route::delete('floors/{floor}', [FloorsController::class, 'destroy'])->name('floors.delete');
        Route::put('floors/{floor}', [FloorsController::class,'update'])->name('floors.update');
*/
});
   
