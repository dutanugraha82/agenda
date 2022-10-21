<?php

namespace App\Http\Controllers;

use App\Http\Requests\Unit\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUnit = Unit::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataUnit)
            ->addIndexColumn()
            ->addColumn('action', function($dataUnit){
                return '<div class"container-fluid">
                        <div class="d-flex">
                        <a href="/superadmin/unit/'.$dataUnit->id.'/edit" style="width:5rem;" class="btn btn-warning mr-2">Edit</a>
                        <a href="/superadmin/unit/delete/'.$dataUnit->id.'" style="width:5rem;" class="btn btn-danger ml-2">Delete</a>
                        </div>
                        </div>
                        ';
                    })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('layouts.pages.unit.data-unit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.unit.input-unit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        Unit::create($request->validated());
        return redirect('/superadmin/unit')->with('success','Data Berhasil Diinput');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailUnit = Unit::find($id);
        // dd($detailUnit);
        return view('layouts.pages.unit.edit-unit',compact('detailUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        Unit::where('id', $id)->update(
            $request->safe()->except(['_method', '_token']));
            Alert::info('Data Updated!', 'Data success updated!');
            return redirect ('/superadmin/unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::find($id)->delete();
        Alert::warning('Delete Success','Data has deleted');
        return redirect ('/superadmin/unit');
    }
}
