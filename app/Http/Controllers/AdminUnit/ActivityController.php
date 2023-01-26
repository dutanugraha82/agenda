<?php

namespace App\Http\Controllers\AdminUnit;

use App\Http\Requests\AdminUnit\StoreActivityRequest;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $activities = Activity::where('unit_id',auth()->user()->unit_id)->orderBy('updated_at','desc')->get();

            return datatables()->of($activities)
                               ->addIndexColumn()
                                ->addColumn('action',function($row){
                                    return '<div class="d-flex justify-content-start">
                                                            <a href="/adminunit/activities/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action='.route('activities.destroy',['activity' => $row->id]).' method="POST">
                                                                '.csrf_field().'
                                                                '.method_field("DELETE").'
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus kegiatan ?\')">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                        ';

                                })
                                ->rawColumns(['action'])
                                ->make(true);
        }

        return view('adminunit.activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminunit.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityRequest $request)
    {

        Activity::create($request->validated() + ['unit_id' => auth()->user()->unit_id,'act_status' => 'pending')->store('kegiatan')]);
        Alert::success('Berhasil','Agenda kegiatan berhasil disimpan');
        return redirect()->route('activities.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('adminunit.activity.edit',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActivityRequest $request, $id)
    {
        
        Activity::findOrFail($id)->update($request->validated());
        Alert::success('Berhasil','Agenda kegiatan berhasil disunting');
        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        Alert::success('Berhasil','Agenda kegiatan berhasil dihapus');
        return redirect()->route('activities.index');
    }
}
