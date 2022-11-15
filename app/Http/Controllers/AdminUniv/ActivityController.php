<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{
    public function index(){
        if(request()->ajax()) {
            $activities = Activity::with('unit')->where('act_status','!=','publish')->orderBy('updated_at','desc')->get();
            return datatables()->of($activities)
                               ->addIndexColumn()
                               ->addColumn('action',function($row){
                                    return '<a href="/adminuniv/activities/'.$row->id.'" class="btn btn-success btn-sm">
                                            <i class="fas fa-check-circle"></i>
                                            Verifikasi</a>';
                                })
                                ->rawColumns(['action'])
                                ->make(true);
        }

        return view('adminuniv.activity.activity');
    }

    public function verification($id) {
        $activity = Activity::with('unit')->find($id);
        return view('adminuniv.activity.verif',compact('activity'));
    }

    public function submit_verification(Request $request,$id) {

        Activity::find($id)->update($request->only('act_status','feedback'));
        Alert::success('Berhasil','Agenda kegiatan berhasil di verifikasi');
        return redirect()->route('adminuniv.activities');
    }
}
