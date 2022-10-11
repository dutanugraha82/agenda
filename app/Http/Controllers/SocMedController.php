<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Models\SocialMedia;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SocMedController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            return datatables()
                    ->of(SocialMedia::get())
                    ->addIndexColumn()
                    ->addColumn('action', function($dataSocialMed){
                        return '<div class="btn-group d-flex">
                        <a href="/social-media/detail/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        <a href="/social-media/edit/'.$dataSocialMed->id.'" class="btn btn-warning ml-3">Edit</a>
                        </div>';
                    })
                    ->addColumn('unit', function($dataSocmed){
                        return $dataSocmed->Unit->unit_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.pages.social-media.social-media');
        
    }

    public function input(){
        $dataUnit = Unit::all();
        return view('layouts.pages.social-media.input-social-media', compact('dataUnit'));
    }

    public function store(SocialMediaRequest $request){
        $validation = $request->validated();
        $validation['thumbnail'] = $request->file('thumbnail')->store('thumbnail-socmed');
        SocialMedia::create($validation);
        Alert::success('Data Stored!','Data social media stored!');
        return redirect('/social-media');
    }

    public function detail($id){
        $dataSocialMed = SocialMedia::find($id);
        return view('layouts.pages.social-media.detail',compact('dataSocialMed'));
    }

    public function edit($id){
        $dataSocialMed = SocialMedia::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.social-media.edit',compact('dataSocialMed','dataUnit'));
    }

    public function update($id, SocialMediaRequest $request){
        if($request->file('thumbnail')){
            $validation = $request->validated();
            $validation['thumbnail'] = $request->file('thumbnail')->store('thumbnail-socmed');
            Storage::delete($request->oldImage);
            SocialMedia::find($id)->update($validation);
        }else{
            SocialMedia::find($id)->update($request->validated());
        }
        Alert::warning('Data Updated!','Data success updated!');
        return redirect('/social-media');
    }

    public function delete($id, Request $request){
        Storage::delete($request->oldImage);
        SocialMedia::find($id)->delete();
        Alert::warning('Data Deleted!','Data success deleted!');
        return redirect('/social-media');
    }
}
