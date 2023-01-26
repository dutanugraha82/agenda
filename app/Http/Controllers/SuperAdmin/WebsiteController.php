<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $websites = \App\Models\Website::with('unit')->get();
            return datatables()
            ->of($websites)
            ->addIndexColumn()
            ->make(true);
        }
        return view('superadmin.website');
    }
}
