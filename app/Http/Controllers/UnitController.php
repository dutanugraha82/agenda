<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\SocMed;
use App\Http\Requests\Unit\UnitRequest;
use App\Http\Requests\Unit\SocmedRequest;

class UnitController extends Controller
{
    public function unit(){
        $dataUnit = Unit::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataUnit)
            ->addIndexColumn()
            ->addColumn('action', function($dataUnit){
                return '<a href="/superadmin/input/edit/'.$dataUnit->id.'" class="btn btn-sm btn-warning btn-block mx-auto">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('layouts.pages.unit.data-unit');
    }

    public function inputUnit(){
        return view('layouts.pages.unit.input-unit');
    }

    public function storeUnit(UnitRequest $request){

        // dd($request);
        Unit::create($request->validated());
        return redirect('/superadmin/data-unit')->with('success','Data Berhasil Diinput');
    }

    public function editUnits($id){
        $detailUnit = Unit::find($id);
        // dd($detailUnit);
        return view('layouts.pages.unit.edit-unit',compact('detailUnit'));
    }

    public function updateUnits($id, UnitRequest $request){
         Unit::where('id', $id)->update(
            $request->safe()->except(['_method', '_token']));
            return redirect ('/superadmin/data-unit');
    }

    public function deleteUnits($id){
        Unit::find($id)->delete();
        return redirect ('/superadmin/data-unit');
    }

    public function socMed(){
        $dataSocmed = SocMed::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataSocmed)
            ->addIndexColumn()
            ->addColumn('action', function($dataSocmed){
                return '
                <div class="text-center">
                <a href="/superadmin/edit-socmed/'.$dataSocmed->id.'" style="width:5rem;" class="btn btn-sm btn-warning">Edit</a>
                <button type="submit" style="width:5rem;" class="btn btn-sm btn-danger text-center">Delete</button>
                </div>';
                
            })
            ->addColumn('unit', function($dataSocmed){
                return $dataSocmed->Unit->unit_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('layouts.pages.unit.social-media');
    }

    public function inputSocmed(){
        $dataUnit = Unit::all();
        return view('layouts.pages.unit.input-socmed',compact('dataUnit'));
    }

    public function storeSocmed(SocmedRequest $request){
        SocMed::create($request->validated());
        return redirect('/superadmin/social-media')->with('success','Data Unit Social Media submited!');
    }

    public function editSocmed($id){
        $dataSocmed = SocMed::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.unit.edit-socmed',compact('dataSocmed','dataUnit'));
    }

    public function updateSocmed($id, SocmedRequest $request){
        SocMed::where('id',$id)->update($request->validated());

        return redirect('/superadmin/social-media')->with('success','Data Unit Social Media Updated!');
    }

    public function deleteSocmed($id){
        SocMed::find($id)->delete();
        return redirect('/superadmin/social-media');
    }
}
