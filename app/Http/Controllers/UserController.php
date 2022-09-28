<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Unit\UnitRequest;
class UserController extends Controller
{

    public function index(){
        return view('layouts.pages.dashboard');
    }

    public function unit(){

        $data = Unit::all();
        // dd($data);
        return view('layouts.pages.unit.data-unit',compact('data'));
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

}
