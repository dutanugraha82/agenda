<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
// use App\Http\Middleware\SuperAdminMiddleware;
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

Route::middleware(['superadmin','auth'])->prefix('superadmin')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('/data-unit',[UserController::class,'unit']);
    Route::get('/input-unit',[UserController::class,'inputUnit']);
    Route::post('/store-unit',[UserController::class,'storeunit']);
});

Route::middleware('AdminUniv')->prefix('AdminUniv')->group(function(){
    //THIS IS FOR ADMIN UNIV
});

Route::middleware('AdminUnit')->prefix('AdminUnit')->group(function(){
    //THIS IS FOR ADMIN UNIT
});