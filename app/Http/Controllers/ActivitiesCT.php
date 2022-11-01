<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivitiesRequest;
use App\Models\Unit;
use App\Models\Activities;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ActivitiesCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataActivities = Activities::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataActivities)
            ->addIndexColumn()
            ->addColumn('action', function($dataActivities){
                if (auth()->user()->role == "admin_unit") {
                    return '
                <div class="text-center">
                <a href="/adminunit/activities/'.$dataActivities->id.'/edit" style="width:5rem;" class="btn btn-sm btn-warning">Edit</a>
                <a href="/adminunit/activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-primary">Detail</a>
                </div>';
                } elseif(auth()->user()->role == "admin_univ") {
                    return '
                <div class="text-center">
                <a href="/adminuniv/activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-primary">Detail</a>
                </div>';
                } elseif(auth()->user()->role == "super_admin"){
                    return '
                    <div class="text-center">
                    <a href="/superadmin/activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-primary">Detail</a>
                    </div>';
                }
                
            })
            ->addColumn('unit', function($dataSocmed){
                return $dataSocmed->Unit->unit_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('layouts.pages.activities.activities');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::get();
        return view('layouts.pages.activities.input-activities', compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivitiesRequest $request)
    {
        Activities::create($request->validated());
        Alert::success('Success!','Data activities has stored!');
        return redirect('/adminunit/activities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataActivities = Activities::find($id);
        return view('layouts.pages.activities.detail-activities',compact('dataActivities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataActivities = Activities::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.activities.edit-activities', compact('dataActivities','dataUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function actPending(){
        $dataActivities = Activities::where('act_status','=','pending')->get();
        if(request()->ajax()){
            return datatables()
            ->of($dataActivities)
            ->addIndexColumn()
            ->addColumn('action', function($dataActivities){
                return '
                <div class="text-center">
                <a href="/adminuniv/activities/'.$dataActivities->id.'" style="width:5rem;" class="btn btn-sm btn-primary">Detail</a>
                </div>';
                
            })
            ->addColumn('unit', function($dataSocmed){
                return $dataSocmed->Unit->unit_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('layouts.pages.activities.activities-pending',compact('dataActivities'));
    }

    public function actPublish($id){
        Activities::find($id)->update([
            'act_status' => 'published'
        ]);

        Alert::success('Publish Success','Data success published!');
        return redirect('/adminunit/activities/pending');
    }

    public function update(ActivitiesRequest $request, $id)
    {
        Activities::where('id',$id)->update($request->validated());
        Alert::info('Data Updated!','Data success updated!');
        return redirect('/adminunit/activities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activities::find($id)->delete();
        Alert::warning('Data Deleted!','Data success deleted!');
        return redirect('/adminunit/activities');
    }
}
