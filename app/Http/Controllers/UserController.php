<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){
        $dataActivities = DB::table('activities')->count();
        $dataActivitiesPending = DB::table('activities')->where('act_status','=', 'pending')->count();
        $dataSocMed = DB::table('social_media')->count();
        $dataSocMedPending = DB::table('social_media')->where('socmed_status','=','pending')->count();
        $dataWebsites = DB::table('websites')->count();
        $dataWebsitesPending = DB::table('websites')->where('web_status','=','pending')->count();
        return view('layouts.pages.dashboard',compact('dataActivities','dataActivitiesPending','dataSocMed','dataSocMedPending','dataWebsites','dataWebsitesPending'));
    }

}
