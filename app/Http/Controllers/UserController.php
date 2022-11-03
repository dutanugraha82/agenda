<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\SocialMedia;
use App\Models\SocMed;
use App\Models\Unit;
use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){

        $dataActivities = DB::table('activities')->count();
        $dataActivitiesPending = DB::table('activities')->where('act_status','=', 'pending')->count();
        $dataActivitiesPublish = DB::table('activities')->where('act_status','=','published')->count();
        $dataSocMed = DB::table('social_media')->count();
        $dataSocMedPending = DB::table('social_media')->where('socmed_status','=','pending')->count();
        $dataSocMedPublish = DB::table('social_media')->where('socmed_status','=','published')->count();
        $dataWebsites = DB::table('websites')->count();
        $dataWebsitesPending = DB::table('websites')->where('web_status','=','pending')->count();
        $dataWebsitesPublish = DB::table('websites')->where('web_status','=','published')->count();
        return view('layouts.pages.dashboard',compact('dataActivities','dataActivitiesPending','dataSocMed','dataSocMedPending','dataWebsites','dataWebsitesPending','dataActivitiesPublish','dataSocMedPublish','dataWebsitesPublish'));
    }

    public function report(){

        

        $dataWebsites = Unit::select('unit_name',DB::raw('count(websites.unit_id) as jumlah'))->leftJoin('websites',function($join){
            $join->on('units.id','=','websites.unit_id');
        })->groupBy('unit_name')->get();

        $totalWebsite = [];
        $unitWebsites = [];
        foreach ($dataWebsites as $item) {
            $totalWebsites[] = $item->jumlah;
            $unitWebsites[] = $item->unit_name;
        }

        $dataActivities = Unit::select('unit_name',DB::raw('count(activities.unit_id) as jumlah'))->leftJoin('activities',function($join){
            $join->on('units.id','=','activities.unit_id');
        })->groupBy('unit_name')->get();

        $totalActivities = [];
        $unitActivities = [];
        foreach ($dataActivities as $item) {
            $totalActivities[] = $item->jumlah;
            $unitActivities[] = $item->unit_name;
        }
        
        $dataSocMed = Unit::select('unit_name',DB::raw('count(social_media.unit_id) as jumlah'))->leftJoin('social_media',function($join){
            $join->on('units.id','=','social_media.unit_id');
        })->groupBy('unit_name')->get();

        $totalSocMed = [];
        $unitSocMed = [];
        foreach ($dataSocMed as $item) {
            $totalSocMed[] = $item->jumlah;
            $unitSocMed[] = $item->unit_name;
        }
       

// dd($dataActivities);
        return view('layouts.pages.report',compact('unitWebsites','totalWebsites','unitActivities','totalActivities','unitSocMed','totalSocMed'));
    }

}
