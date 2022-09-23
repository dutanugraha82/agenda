<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\SuperAdmin\DashboardController;
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

Route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login-proses',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::middleware('SuperAdmin')->prefix('SuperAdmin')->group(function(){
    Route::get('/',[UserController::class,'index'])->middleware('auth');
});

Route::middleware('AdminUniv')->prefix('AdminUniv')->group(function(){
    //THIS IS FOR ADMIN UNIV
});

Route::middleware('AdminUnit')->prefix('AdminUnit')->group(function(){
    //THIS IS FOR ADMIN UNIT
});