<?php
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
// use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UnitController;
use App\Models\Unit;

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
Route::get('/data-unit',[UnitController::class,'unit']);
Route::get('/input-unit',[UnitController::class,'inputUnit']);
Route::post('/store-unit',[UnitController::class,'storeunit']);
Route::get('/input/edit/{units_id}',[UnitController::class,'editUnits']);
Route::put('/update-unit/{units_id}', [UnitController::class,'updateUnits']);
Route::delete('/delete-unit/{units_id}', [UnitController::class,'deleteUnits']);
Route::get('/create-admin-univ',[UserController::class,'createAdminUniv']);
});

Route::middleware('adminuniv')->prefix('adminuniv')->group(function(){
    //THIS IS FOR ADMIN UNIV
});

Route::middleware('adminunit')->prefix('adminunit')->group(function(){
    //THIS IS FOR ADMIN UNIT
});

// Route Social Media Start
Route::get('/social-media',[UnitController::class,'socMed']);
Route::get('/input-unit-socmed',[UnitController::class,'inputSocmed']);
Route::post('/store-socmed',[UnitController::class,'storeSocmed']);
// Route Social Media End