<?php
use App\Http\Controllers\ActivitiesCT;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakeUsersCT;
use App\Http\Controllers\SocialMediaCT;
use App\Http\Controllers\UnitCT;
use App\Http\Controllers\UnitSocMedCT;
use App\Http\Controllers\WebsitesCT;
use App\Models\Activities;
use App\Http\Controllers\SuperAdmin\AdminUnivController;
use App\Http\Controllers\SuperAdmin\AdminUnitController;
use App\Http\Controllers\SuperAdmin\UnitController as SuperAdminUnit;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboard;

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

Route::post('unit/select2',[SuperAdminUnit::class,'select2'])->name('getUnit');

Route::middleware(['superadmin','auth','revalidate'])->prefix('superadmin')->group(function(){

    Route::get('/',[SuperAdminDashboard::class,'index']);

    Route::prefix('pengguna')->group(function() {
        Route::resource('admin-univ',AdminUnivController::class)->names(['index' => 'superadmin.pengguna.admin-univ']);
        Route::resource('admin-unit',AdminUnitController::class)->names(['index' => 'superadmin.pengguna.admin-unit']);
    });

    Route::resource('unit',SuperAdminUnit::class);

    // Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('/activities/pending',[ActivitiesCT::class,'actPending'])->name('act-pending');
    Route::get('/website/pending',[WebsitesCT::class,'pending'])->name('web-pending');
    Route::get('/social-media/pending',[SocialMediaCT::class,'socMedPending'])->name('socmed-pending');
    Route::get('/unit/delete/{unit_id}',[UnitCT::class,'destroy']);
    Route::get('/unit-socmed/delete/{unit_id}',[UnitSocMedCT::class,'destroy']);
    Route::resource('users',MakeUsersCT::class)->names(['index' => 'users']);
    Route::resource('social-media',SocialMediaCT::class)->except(['create','store'])->names(['index' => 'social-media']);
    Route::resource('website',WebsitesCT::class)->except(['create','store'])->names(['index' => 'websites']);
    Route::resource('activities',ActivitiesCT::class)->except(['create','store'])->names(['index' => 'activities']);
});

Route::middleware(['adminuniv','auth','revalidate'])->prefix('adminuniv')->group(function(){
    // Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('/activities/pending',[ActivitiesCT::class,'actPending'])->name('act-pending');
    Route::get('/website/pending',[WebsitesCT::class,'pending'])->name('web-pending');
    Route::get('/social-media/pending',[SocialMediaCT::class,'socMedPending'])->name('socmed-pending');
    Route::put('/website/{websites_id}/publish',[WebsitesCT::class,'published']);
    Route::put('/activities/{activities_id}/publish',[ActivitiesCT::class,'actPublish']);
    Route::put('/social-media/{social_media_id}/publish',[SocialMediaCT::class,'socMedPublish']);
    Route::resource('social-media',SocialMediaCT::class)->except(['create','store'])->names(['index' => 'social-media']);
    Route::resource('website',WebsitesCT::class)->except(['create','store'])->names(['index' => 'websites']);
    Route::resource('activities',ActivitiesCT::class)->except(['create','store'])->names(['index' => 'activities']);
    Route::resource('unit',UnitCT::class)->except(['destroy','create','store'])->names(['index' => 'unit']);
    Route::resource('unit-socmed', UnitSocMedCT::class)->except(['destroy','create','store'])->names(['index'=>'unit-socmed']);
});

Route::middleware(['adminunit','auth','revalidate'])->prefix('adminunit')->group(function(){
    // Route::get('/',[UserController::class,'index'])->name('home');
    Route::resource('website',WebsitesCT::class)->only(['create','index','store'])->names(['index' => 'websites']);
    Route::resource('activities',ActivitiesCT::class)->only(['index','create','store'])->names(['index' => 'activities']);
    Route::resource('social-media',SocialMediaCT::class)->only(['index','create','store'])->names(['index' => 'social-media']);
});