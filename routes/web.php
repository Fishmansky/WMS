<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\FormatsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\GoodsInController;
use App\Http\Controllers\DispatchController;


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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('/tasks', TasksController::class)->middleware('auth');
Route::put('/tasks/{task}/assign', [TasksController::class,'assign'])->middleware('auth');
Route::resource('/items', ItemsController::class)->middleware('auth');
Route::resource('/formats', FormatsController::class)->middleware('auth');
Route::resource('/dispatch', DispatchController::class)->middleware('auth');
Route::resource('/goodsin', GoodsInController::class)->middleware('auth');
Route::resource('/workers', WorkersController::class)->middleware('auth');
Route::resource('/locations', LocationsController::class)->middleware('auth');
Route::get('/locations/{location}/put', [LocationsController::class, 'put'])->middleware('auth');
Route::put('/locations/{location}/put', [LocationsController::class, 'putOn'])->middleware('auth');
Route::put('/locations/{location}/unset', [LocationsController::class, 'unsetFormat'])->middleware('auth');
