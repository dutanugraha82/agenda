<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivitiesCT;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\AdminUnit\WebsiteController as AdminUnitWebsite;
use App\Http\Controllers\AdminUnit\SocialMediaController as AdminUnitSocialMedia;
use App\Http\Controllers\AdminUnit\ActivityController as AdminUnitActivity;
use App\Http\Controllers\AdminUniv\WebsiteController as AdminUnivWebsite;
use App\Http\Controllers\AdminUniv\ActivityController as AdminUnivActivity;
use App\Http\Controllers\AdminUniv\SocialMediaController as AdminUnivSocialMedia;
use App\Http\Controllers\AdminUniv\ReportController as AdminUnivReport;


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
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::post('unit/select2',[SuperAdminUnit::class,'select2'])->name('getUnit');

Route::middleware(['superadmin','auth','revalidate'])->prefix('superadmin')->group(function(){

    Route::get('/',[SuperAdminDashboard::class,'index']);

    Route::prefix('pengguna')->group(function() {
        Route::resource('admin-univ',AdminUnivController::class)->names(['index' => 'superadmin.pengguna.admin-univ']);
        Route::resource('admin-unit',AdminUnitController::class)->names(['index' => 'superadmin.pengguna.admin-unit']);
    });


    Route::post('socialmedia',[SuperAdminUnit::class,'social_media_store'])->name('superadmin.unit.socialmedia-store');
    Route::get('unit/{id}/socialmedia',[SuperAdminUnit::class,'social_media'])->name('superadmin.unit.socialmedia');
Route::delete('unit/socialmedia/{id}',[SuperAdminUnit::class,'social_media_destroy'])->name('superadmin.unit.socialmedia-destroy');
    Route::resource('unit',SuperAdminUnit::class);
    Route::get('/',[UserController::class,'report']);
    Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('/report',[UserController::class,'report']);
    Route::get('/activities/pending',[ActivitiesCT::class,'actPending'])->name('act-pending');
    Route::get('/website/pending',[WebsitesCT::class,'pending'])->name('web-pending');
    Route::get('/socialmedia/pending',[SocialMediaCT::class,'socMedPending'])->name('socmed-pending');
    Route::get('/unit/delete/{unit_id}',[UnitCT::class,'destroy']);
    Route::get('/unit-socmed/delete/{unit_id}',[UnitSocMedCT::class,'destroy']);
    Route::resource('users',MakeUsersCT::class)->names(['index' => 'users']);
    Route::resource('socialmedia',SocialMediaCT::class)->only(['show','index'])->names(['index' => 'socialmedia']);
    Route::resource('website',WebsitesCT::class)->only(['show','index'])->names(['index' => 'websites']);
    Route::resource('activities',ActivitiesCT::class)->only(['show','index'])->names(['index' => 'activities']);
});

Route::middleware(['adminuniv','auth','revalidate'])->prefix('adminuniv')->group(function(){
    Route::get('/',[UserController::class,'index']);
    Route::controller(AdminUnivActivity::class)->group(function(){
       Route::get('activities','index')->name('adminuniv.activities');
       Route::get('activities/{id}','verification')->name('activity.verification');
       Route::put('activities/verification/{id}','submit_verification')->name('activities.submit-verification');
    });

    Route::controller(AdminUnivSocialMedia::class)->group(function(){
        Route::get('social-media','index')->name('adminuniv.social-media');
        Route::get('social-media/{id}','verification')->name('social-media.verification');
        Route::put('social-media/verification/{id}','submit_verification')->name('social-media.submit-verification');
    });

    Route::controller(AdminUnivWebsite::class)->group(function(){
        Route::get('websites','index')->name('adminuniv.websites');
        Route::get('websites/{id}','verification')->name('website.verification');
        Route::put('websites/verification/{id}','submit_verification')->name('website.submit-verification');
    });

    Route::controller(AdminUnivReport::class)->group(function(){
        Route::get('report-by-unit','reportByUnit');
        Route::get('report-by-date/{from}/{to}','reportByDate');

    });


//    Route::get('activities',[AdminUnivActivity::class,'index'])->name('adminuniv.activities');
//    Route::get('activities/{id}',[AdminUnivActivity::class,'verification'])->name('activity.verification');
//    Route::put('activities/verification/{id}',[AdminUnivActivity::class,'submit_verification'])->name('activities.submit-verification');
//    Route::get('/',[UserController::class,'index'])->name('home');
//    Route::get('/activities/pending',[ActivitiesCT::class,'actPending'])->name('act-pending');
//    Route::get('/website/pending',[WebsitesCT::class,'pending'])->name('web-pending');
//    Route::get('/socialmedia/pending',[SocialMediaCT::class,'socMedPending'])->name('socmed-pending');
//    Route::put('/website/{websites_id}/publish',[WebsitesCT::class,'published']);
//    Route::put('/activities/{activities_id}/publish',[ActivitiesCT::class,'actPublish']);
//    Route::put('/socialmedia/{social_media_id}/publish',[SocialMediaCT::class,'socMedPublish']);
//    Route::resource('socialmedia',SocialMediaCT::class)->only(['show','index'])->names(['index' => 'socialmedia']);
//    Route::resource('website',WebsitesCT::class)->only(['show','index'])->names(['index' => 'websites']);
//    Route::resource('activities',ActivitiesCT::class)->only(['show','index'])->names(['index' => 'activities']);
//    Route::resource('unit',UnitCT::class)->except(['destroy','create','store'])->names(['index' => 'unit']);
//    Route::resource('unit-socmed', UnitSocMedCT::class)->except(['destroy','create','store'])->names(['index'=>'unit-socmed']);
});

Route::middleware(['adminunit','auth','revalidate'])->prefix('adminunit')->group(function(){
    Route::get('/',[UserController::class,'index']);
    Route::resource('websites',AdminUnitWebsite::class);
    Route::resource('socialmedia',AdminUnitSocialMedia::class);
    Route::resource('activities',AdminUnitActivity::class);
});
