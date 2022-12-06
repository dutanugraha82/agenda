<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(){
       
        if(request()->ajax()){
            $socialmedia = \App\Models\SocialMedia::with('unit')->get();
            return datatables()
            ->of($socialmedia)
            ->addIndexColumn()
            ->make(true);
        }
        return view('superadmin.socialmedia');
    }
}
