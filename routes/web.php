<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// MIDDLEWARE
Route::middleware('auth')->group(function(){
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard',[App\Http\Controllers\Dashboard\DashboardController::class, 'index']) -> name('dashboard');

    // MOVIE URL
    Route::get('/dashboard/movie',[App\Http\Controllers\Dashboard\MovieController::class, 'index']) -> name('dashboard.movies');
    Route::get('/dashboard/movies/create',[App\Http\Controllers\Dashboard\MovieController::class, 'create']) -> name('dashboard.movies.create');
    Route::get('/dashboard/movies/{movie}', [App\Http\Controllers\Dashboard\MovieController::class, 'edit'])->name('dashboard.movies.edit');
    Route::put('/dashboard/movies/{movie}',[App\Http\Controllers\Dashboard\MovieController::class, 'update']) -> name('dashboard.movies.update');
    Route::post('/dashboard/movies', [App\Http\Controllers\Dashboard\MovieController::class, 'store']) -> name('dashboard.movies.store');
    Route::delete('/dashboard/movies/{movie}', [App\Http\Controllers\Dashboard\MovieController::class, 'destroy'])->name('dashboard.movies.delete');




    Route::get('/dashboard/theaters',[App\Http\Controllers\Dashboard\TheaterController::class, 'index']) -> name('dashboard.theaters');
    Route::get('/dashboard/theaters/create',[App\Http\Controllers\Dashboard\TheaterController::class, 'create']) -> name('dashboard.theaters.create');
    Route::post('/dashboard/theaters', [App\Http\Controllers\Dashboard\TheaterController::class, 'store']) -> name('dashboard.theaters.store');
    Route::get('/dashboard/tickets',[App\Http\Controllers\Dashboard\TicketController::class, 'index']) -> name('dashboard.tickets');



    // USER
    Route::get('/dashboard/user',[App\Http\Controllers\Dashboard\UserController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard/user/edit/{id}',[App\Http\Controllers\Dashboard\UserController::class, 'edit'])->name('dashboard.user.edit');
    Route::put('/dashboard/user/update/{id}',[App\Http\Controllers\Dashboard\UserController::class, 'update'])->name('dashboard.user.update');
    Route::delete('/dashboard/user/delete/{id}',[App\Http\Controllers\Dashboard\UserController::class, 'destroy']) -> name('dashboard.user.delete');

});
