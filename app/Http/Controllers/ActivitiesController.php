<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Activities;
use Illuminate\Http\Request;
use App\Http\Requests\ActivitiesRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ActivitiesController extends Controller
{
    public function index(){
        $dataActivities = Activities::get();
        if(request()->ajax()){
            return datatables()
            ->of(Activities::get())
            ->addIndexColumn()
            ->addColumn('action', function($dataActivities){
                return '
                <div class="text-center">
                <a href="/edit-activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-warning">Edit</a>
                <a href="/detail-activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-primary">Detail</a>
                </div>';
                
            })
            ->addColumn('unit', function($dataSocmed){
                return $dataSocmed->Unit->unit_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('layouts.pages.activities.activities');
    }

    public function input(){
       $dataUnit = Unit::get();
        return view('layouts.pages.activities.input-activities', compact('dataUnit'));
    }

    public function store(ActivitiesRequest $request){
        // dd($request);
        Activities::create($request->validated());
        Alert::success('Success!','Data activities has stored!');
        return redirect('/activities');
    }

    public function edit($id){
        $dataActivities = Activities::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.activities.edit-activities', compact('dataActivities','dataUnit'));
    }

    public function update($id, ActivitiesRequest $request){
        Activities::where('id',$id)->update($request->validated());
        Alert::warning('Data Updated!','Data success updated!');
        return redirect('/activities');
    }

    public function detail($id){
        $dataActivities = Activities::find($id);
        return view('layouts.pages.activities.detail-activities',compact('dataActivities'));
    }

    public function delete($id){
        Activities::find($id)->delete();
        Alert::warning('Data Deleted!','Data success deleted!');
        return redirect('/activities');
    }
}
