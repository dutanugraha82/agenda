<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index(){
        return view('layouts.pages.dashboard');
    }

    public function unit(){
        return view('layouts.pages.unit.data-unit');
    }

    public function inputUnit(){
        return view('layouts.pages.unit.input-unit');
    }

    public function storeUnit(Request $request){
        $request->validate([
            'unit_name' => 'required',
            'url' => 'required'
        ]);
        // dd($request);
        Unit::create($request->all());
        return redirect('/superadmin/data-unit');
    }

}
