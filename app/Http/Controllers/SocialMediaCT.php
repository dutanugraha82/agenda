<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SocialMedia\SocialMediaRequest;

class SocialMediaCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()
                    ->of(SocialMedia::get())
                    ->addIndexColumn()
                    ->addColumn('action', function($dataSocialMed){
                        if (auth()->user()->role == "admin_unit") {
                            return '<div class="btn-group d-flex">
                        <a href="/adminunit/social-media/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        <a href="/adminunit/social-media/'.$dataSocialMed->id.'/edit" class="btn btn-warning ml-3">Edit</a>
                        </div>';
                        } elseif(auth()->user()->role == "admin_univ") {
                            return '<div class="btn-group d-flex">
                            <a href="/adminuniv/social-media/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                            </div>';
                        }elseif(auth()->user()->role == "super_admin"){
                            return '<div class="btn-group d-flex">
                        <a href="/superadmin/social-media/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        </div>';
                        } 
                        
                    })
                    ->addColumn('unit', function($dataSocmed){
                        return $dataSocmed->Unit->unit_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.pages.social-media.social-media');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        return view('layouts.pages.social-media.input-social-media', compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialMediaRequest $request)
    {
        $validation = $request->validated();
        $validation['thumbnail'] = $request->file('thumbnail')->store('thumbnail-socmed');
        SocialMedia::create($validation);
        Alert::success('Data Stored!','Data social media stored!');
        return redirect('/adminunit/social-media');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataSocialMed = SocialMedia::find($id);
        return view('layouts.pages.social-media.detail',compact('dataSocialMed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataSocialMed = SocialMedia::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.social-media.edit',compact('dataSocialMed','dataUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialMediaRequest $request, $id)
    {
        if($request->file('thumbnail')){
            $validation = $request->validated();
            $validation['thumbnail'] = $request->file('thumbnail')->store('thumbnail-socmed');
            Storage::delete($request->oldImage);
            SocialMedia::find($id)->update($validation);
        }else{
            SocialMedia::find($id)->update($request->validated());
        }
        Alert::info('Data Updated!','Data success updated!');
        return redirect('/adminunit/social-media');
    }

    public function socMedPending(){
        if (request()->ajax()) {
            return datatables()
                    ->of(SocialMedia::where('socmed_status','=','pending')->get())
                    ->addIndexColumn()
                    ->addColumn('action', function($dataSocialMed){
                        return '<div class="btn-group d-flex">
                        <a href="/adminuniv/social-media/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        </div>';
                    })
                    ->addColumn('unit', function($dataSocmed){
                        return $dataSocmed->Unit->unit_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.pages.social-media.data-pending');

    }

    public function socMedPublish($id){
        SocialMedia::find($id)->update([
            'socmed_status' => 'published'
        ]);
        
        Alert::success('Data Published!','Data success published!');
        return redirect('/adminuniv/social-media/pending');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Storage::delete($request->oldImage);
        SocialMedia::find($id)->delete();
        Alert::warning('Data Deleted!','Data success deleted!');
        return redirect('/adminunit/social-media');
    }
}
