<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        
        if(request()->ajax()){
            $activities = \App\Models\Activity::with('unit')->get();
            return datatables()
            ->of($activities)
            ->addIndexColumn()
           
            ->make(true);
        }
        return view('superadmin.activity');
    }
}
