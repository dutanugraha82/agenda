<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\SocialMedia;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function reportByUnit(){
        $websites = Website::select('units.unit_name',
                        DB::raw("sum(if(web_status = 'reject',1,0)) as reject"),
                        DB::raw("sum(if(web_status = 'pending',1,0)) as pending"),
                        DB::raw("sum(if(web_status = 'publish',1,0)) as publish"),
                )->join('units',function($join){
                    $join->on('units.id','=','websites.unit_id');
                })->groupBy('units.unit_name')->get();

        $activities = Activity::select('units.unit_name',
            DB::raw("sum(if(act_status = 'reject',1,0)) as reject"),
            DB::raw("sum(if(act_status = 'pending',1,0)) as pending"),
            DB::raw("sum(if(act_status = 'publish',1,0)) as publish"),
        )->join('units',function($join){
            $join->on('units.id','=','activities.unit_id');
        })->groupBy('units.unit_name')->get();

        $socialMedia = SocialMedia::select('units.unit_name',
            DB::raw("sum(if(socmed_status = 'reject',1,0)) as reject"),
            DB::raw("sum(if(socmed_status = 'pending',1,0)) as pending"),
            DB::raw("sum(if(socmed_status = 'publish',1,0)) as publish"),
        )->join('units',function($join){
            $join->on('units.id','=','social_media.unit_id');
        })->groupBy('units.unit_name')->get();



        echo json_encode($socialMedia);
        dd($activities);
        dd($websites);
    }

    public function reportByDate($from,$to){

//        $from = '2022-11-01';
//        $to   = '2023-01-01';

        $websites = Website::select('units.unit_name',
            DB::raw("sum(if(web_status = 'reject',1,0)) as reject"),
            DB::raw("sum(if(web_status = 'pending',1,0)) as pending"),
            DB::raw("sum(if(web_status = 'publish',1,0)) as publish"),
        )->join('units',function($join){
            $join->on('units.id','=','websites.unit_id');
        })->groupBy('units.unit_name')->whereBetween('websites.updated_at',[$from,$to])->get();
        dd($websites);
    }
}
