<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteRequest;
use DataTables;

class WebsiteController extends Controller
{
    public function index(){
        return view('layouts.pages.website.website');
    }
    
    public function json(){
        
        $dataWebsite = Website::all();
        return DataTables::of($dataWebsite)
                ->make(true);
    }

    public function input(){
        $dataUnit = Unit::all();
        return view('layouts.pages.website.input-website',compact('dataUnit'));
    }

    public function store(WebsiteRequest $request){
        $validation = $request->validated();
        $validation['web_thumbnail'] = $request->file('web_thumbnail')->store('web-thumbnail');
        Website::create($validation);
        
        // dd($image);
        return redirect('/websites')->with('success','Data Submited!');
    }

}
