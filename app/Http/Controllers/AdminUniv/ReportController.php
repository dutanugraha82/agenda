<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\SocialMedia;
use App\Models\Unit;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function reportByUnit(){

        $websites = Website::select('units.unit_name',
                        // DB::raw("concat(sum(if(web_status = 'reject',1,0)),','
                        //                 sum(if(web_status = 'pending',1,0)),','
                        //                 sum(if(web_status = 'publish',1,0))
                        //         )"),
                        DB::raw("sum(if(web_status = 'reject',1,0)) as reject"),
                        DB::raw("sum(if(web_status = 'pending',1,0)) as pending"),
                        DB::raw("sum(if(web_status = 'publish',1,0)) as publish")
                )->rightJoin('units',function($join){
                    $join->on('units.id','=','websites.unit_id');
                })->groupBy('units.unit_name')->get();

        $socialMedia = SocialMedia::select('units.unit_name',
                        DB::raw("sum(if(socmed_status = 'reject',1,0)) as reject"),
                        DB::raw("sum(if(socmed_status = 'pending',1,0)) as pending"),
                        DB::raw("sum(if(socmed_status = 'publish',1,0))as publish"),
        )->rightJoin('units',function($join){
            $join->on('units.id','=','social_media.unit_id');
        })->groupBy('units.unit_name')->get();

        $activities = Activity::select('units.unit_name',
                        DB::raw("sum(if(act_status = 'reject',1,0)) as reject"),
                        DB::raw("sum(if(act_status = 'pending',1,0)) as pending"),
                        DB::raw("sum(if(act_status = 'publish',1,0)) as publish"),
        )->rightJoin('units',function($join){
            $join->on('units.id','=','activities.unit_id');
        })->groupBy('units.unit_name')->get();
       
        // dd($activities);

        return view('layouts.pages.website.report-website', compact('websites','socialMedia','activities'));
        
        // dd($labels2);
        // $dataWebsites = [];
        // foreach($websites as $row){

        //     array_push($dataWebsites,[
        //         'pending' => $row->pending,
        //         'reject' => $row->reject,
        //         'publish' => $row->publish,
        //     ]);

        // }

        // foreach($dataWebsites as $row) {

        // }
        // print_r($labelWebsites);

        // print_r($dataWebsites);
        // die;
         
        // dd($websites);

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

        $tempLabel = '';
        $labels = [];
        foreach($websites as $row) {
            if($tempLabel != $row->unit_name) {

            }
        }

        // foreach ($websites as $item) {
        //     // $data = [];
        //     $label[] = $item->unit_name;
        //     $data = [$item->pending,$item->reject,$item->publish];
        // }

        // dd($data);

        // foreach ($websites as $item) {
        //     $pending[] = $item->pending;
        //     $reject[] = $item->reject;
        //     $publish[] = $item->publish;
        // }
        // dd($websites);
    //    return view('layouts.pages.website.report-website', compact('websites','label','pending','reject','publish'));
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
