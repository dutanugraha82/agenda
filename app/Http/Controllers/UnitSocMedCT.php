<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\SocmedRequest;
use App\Models\Unit;
use App\Models\SocMed;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitSocMedCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSocmed = SocMed::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataSocmed)
            ->addIndexColumn()
            ->addColumn('action', function($dataSocmed){
                return '<div class="container-fluid">
                        <div class="d-flex">
                        <a href="/superadmin/unit-socmed/'.$dataSocmed->id.'/edit" style="width:5rem;" class="btn btn-warning mr-2">Edit</a>
                        <a href="/superadmin/unit-socmed/delete/'.$dataSocmed->id.'" style="width:5rem;" class="btn btn-danger ml-2">Delete</a>
                        </div>
                        </div>
                        ';

            })
            ->addColumn('unit', function($dataSocmed){
                return $dataSocmed->Unit->unit_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('layouts.pages.unit.socialmedia');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        return view('layouts.pages.unit.input-socmed',compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocmedRequest $request)
    {
        SocMed::create($request->validated());
        Alert::success('Data Stored!','Data success stored!');
        return redirect('/superadmin/unit-socmed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataSocmed = SocMed::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.unit.edit-socmed',compact('dataSocmed','dataUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocmedRequest $request, $id)
    {
        SocMed::where('id',$id)->update($request->validated());
        Alert::info('Data Updated!','Data success updated!');
        return redirect('/superadmin/unit-socmed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SocMed::find($id)->delete();
        Alert::warning('Delete Success','Data has deleted');
        return redirect('/superadmin/unit-socmed');
    }
}
