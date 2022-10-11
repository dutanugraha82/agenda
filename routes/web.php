<?php

use App\Http\Controllers\ActivitiesController;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
// use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocMedController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WebsiteController;
use App\Models\SocMed;
use App\Models\Unit;
use App\Models\Website;

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
Route::get('/data-unit',[UnitController::class,'unit'])->name('unit');
Route::get('/input-unit',[UnitController::class,'inputUnit']);
Route::post('/store-unit',[UnitController::class,'storeunit']);
Route::get('/input/edit/{units_id}',[UnitController::class,'editUnits']);
Route::put('/update-unit/{units_id}', [UnitController::class,'updateUnits']);
Route::get('/delete-unit/{units_id}', [UnitController::class,'deleteUnits']);
Route::get('/create-admin-univ',[UserController::class,'createAdminUniv']);
Route::get('/social-media',[UnitController::class,'socMed'])->name('socmed');
Route::get('/input-unit-socmed',[UnitController::class,'inputSocmed']);
Route::post('/store-socmed',[UnitController::class,'storeSocmed']);
Route::get('/edit-socmed/{id}',[UnitController::class,'editSocmed']);
Route::put('/update-unit-socmed/{id}',[UnitController::class,'updateSocmed']);  
Route::get('/delete-socmed/{id}',[UnitController::class,'deleteSocmed']);
});

Route::middleware('adminuniv')->prefix('adminuniv')->group(function(){
    //THIS IS FOR ADMIN UNIV
});

Route::middleware('adminunit')->prefix('adminunit')->group(function(){
    //THIS IS FOR ADMIN UNIT
});

//Route Website Start
Route::get('/websites',[WebsiteController::class,'index'])->name('websites');
Route::get('/input-website',[WebsiteController::class,'input']);
Route::post('/store-website',[WebsiteController::class,'store']);
Route::get('/website/detail/{websites_id}',[WebsiteController::class,'detail']);
Route::get('/website/edit/{websites_id}',[WebsiteController::class,'edit']);
Route::put('/website/update/{websites_id}',[WebsiteController::class,'update']);
Route::delete('/website/delete/{websites_id}',[WebsiteController::class,'delete']);
//Route Website End

// Route Activities Start
Route::get('/activities',[ActivitiesController::class,'index'])->name('activities');
Route::get('/input-activities',[ActivitiesController::class,'input']);
Route::post('/store-activities',[ActivitiesController::class,'store']);
Route::get('/edit-activities/{activities_id}',[ActivitiesController::class,'edit']);
Route::put('/update-activities/{activities_id}',[ActivitiesController::class,'update']);
Route::get('/detail-activities/{activities_id}',[ActivitiesController::class,'detail']);
Route::get('/delete-activities/{activities_id}',[ActivitiesController::class,'delete']);
// Route Activities End

// Route Social Media Start
Route::get('/social-media',[SocMedController::class,'index'])->name('social-media');
Route::get('/input-social-media',[SocMedController::class,'input']);
Route::post('/store-social-media',[SocMedController::class,'store']);
Route::get('/social-media/detail/{social_media_id}',[SocMedController::class,'detail']);
Route::get('/social-media/edit/{social_media_id}',[SocMedController::class,'edit']);
Route::put('/update-social-media/{social_media_id}',[SocMedController::class,'update']);
Route::delete('/delete-social-media/{social_media_id}',[SocMedController::class,'delete']);
// Route Social Media End