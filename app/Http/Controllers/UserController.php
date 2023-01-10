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

    public function reportWebsite(){
        $dataUnit = Unit::all();
        $total = $dataUnit->count();
        // dd($dataUnit);
        return view('layouts.pages.report-unit',compact('dataUnit','total'));
    }


}
