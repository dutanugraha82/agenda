<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteRequest;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function index(){
        $dataWebsite = Website::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataWebsite)
            ->addIndexColumn()
            ->addColumn('Action', function($dataWebsite){
                return '<div class="btn-group d-flex">
                        <a href="/website/detail/'.$dataWebsite->id.'" class="btn btn-primary mr-3">Detail</a>
                        <a href="/website/edit/'.$dataWebsite->id.'" class="btn btn-warning ml-3">Edit</a>
                        </div>';
            })
            ->rawColumns(['Action'])
            ->make(true);
        }
        return view('layouts.pages.website.website');
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

    public function detail($id){
        $dataWebsite = Website::find($id);
        return view('layouts.pages.website.detail',compact('dataWebsite'));
    }
    
    public function edit($id){
        $dataWebsite = Website::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.website.edit',compact('dataWebsite','dataUnit'));
    }
    
    public function update($id, Request $request){
        // dd($request);
        if($request->file('web_thumbnail')){
            $validation = $request->validate([
                'web_name' => 'required',
                'web_date' => 'required',
                'web_address' => 'required',
                'web_document' => 'required',
                'web_type' => 'required',
                'web_category' => 'required',
                'web_url' => 'required',
                'unit_id' => 'required',
                'web_thumbnail' => 'image'
            ]);
    
           Storage::delete($request->oldImage);
           $validation['web_thumbnail'] = $request->file('web_thumbnail')->store('web-thumbnail');
           Website::where('id',$id)->update($validation);
        
    }else{
            $request->validate([
                'web_name' => 'required',
                'web_date' => 'required',
                'web_address' => 'required',
                'web_document' => 'required',
                'web_type' => 'required',
                'web_category' => 'required',
                'web_url' => 'required',
                'unit_id' => 'required',
            ]);
            
            Website::where('id',$id)->update([
                'web_name' => $request['web_name'],
                'web_date' => $request['web_date'],
                'web_address' => $request['web_address'],
                'web_document' => $request['web_document'],
                'web_type' => $request['web_type'],
                'web_category' => $request['web_category'],
                'web_url' => $request['web_url'],
                'unit_id' => $request['unit_id'],
            ]);
            }
            return redirect('/website/detail/'.$id);
    }

    public function delete($id, Request $request){
        Storage::delete($request->oldImage);
        Website::where('id','=', $id)->delete();
        return redirect('/websites')->with('Data success delete!');
    }

}
