<?php
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
// use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/',[LoginController::class,'login'])->name('login')->middleware('guest');
Route::post('/login-proses',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::middleware(['superadmin','auth'])->prefix('superadmin')->group(function(){
Route::get('/',[UserController::class,'index'])->name('home');
Route::get('/data-unit',[UserController::class,'unit']);
Route::get('/input-unit',[UserController::class,'inputUnit']);
Route::post('/store-unit',[UserController::class,'storeunit']);
Route::get('/input/edit/{units_id}',[UserController::class,'editUnits']);
Route::put('/update-unit/{units_id}', [UserController::class,'updateUnits']);
Route::delete('/delete-unit/{units_id}', [UserController::class,'deleteUnits']);

});

Route::middleware('AdminUniv')->prefix('AdminUniv')->group(function(){
    //THIS IS FOR ADMIN UNIV
});

Route::middleware('AdminUnit')->prefix('AdminUnit')->group(function(){
    //THIS IS FOR ADMIN UNIT
});
