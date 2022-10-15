<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ActivitiesCT;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\AdminUnivMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialMediaCT;
use App\Http\Controllers\SocMedController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitCT;
use App\Http\Controllers\UnitSocMedCT;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsitesCT;

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
    
});

Route::middleware(['adminuniv','auth'])->prefix('adminuniv')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('/unit/delete/{unit_id}',[UnitCT::class,'destroy']);
    Route::get('/unit-socmed/delete/{unit_id}',[UnitSocMedCT::class,'destroy']);
    Route::resource('unit',UnitCT::class)->except(['destroy'])->names(['index' => 'unit']);
    Route::resource('unit-socmed', UnitSocMedCT::class)->except(['destroy'])->names(['index'=>'unit-socmed']);
});

Route::middleware('adminunit')->prefix('adminunit')->group(function(){
   
});

//Route Website Start
Route::resource('website',WebsitesCT::class)->names(['index' => 'websites']);
//Route Website End

// Route Activities Start
Route::resource('activities',ActivitiesCT::class)->except(['index'])->names(['index' => 'activities']);
// Route Activities End

// Route Social Media Start
Route::resource('social-media',SocialMediaCT::class)->names(['index' => 'social-media']);

// Route Social Media End