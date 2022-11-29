<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\SuperAdmin\StoreSocialMediaRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SocialMediaCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSocialMed = SocialMedia::all();
        if (request()->ajax()) {
            return datatables()
                    ->of($dataSocialMed)
                    ->addIndexColumn()
                    ->addColumn('action', function($dataSocialMed){
                        if (auth()->user()->role == "admin_unit") {
                            return '<div class="btn-group d-flex">
                        <a href="/adminunit/socialmedia/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        <a href="/adminunit/socialmedia/'.$dataSocialMed->id.'/edit" class="btn btn-warning ml-3">Edit</a>
                        </div>';
                        } elseif(auth()->user()->role == "admin_univ") {
                            return '<div class="btn-group d-flex">
                            <a href="/adminuniv/socialmedia/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                            </div>';
                        }elseif(auth()->user()->role == "super_admin"){
                            return '<div class="btn-group d-flex">
                        <a href="/superadmin/socialmedia/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        </div>';
                        }

                    })
                    ->addColumn('unit', function($dataSocmed){
                        return $dataSocmed->Unit->unit_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('superadmin.unit.social-media');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        return view('layouts.pages.socialmedia.input-socialmedia', compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $validation = $request->validated();
        $validation['thumbnail'] = $request->file('thumbnail')->store('thumbnail-socmed');
        SocialMedia::create($validation);
        Alert::success('Data Stored!','Data social media stored!');
        return redirect('/adminunit/socialmedia');
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
        return view('layouts.pages.socialmedia.detail',compact('dataSocialMed'));
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
        return view('layouts.pages.socialmedia.edit',compact('dataSocialMed','dataUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSocialMediaRequest $request, $id)
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
        return redirect('/adminunit/socialmedia');
    }

    public function socMedPending(){
        if (request()->ajax()) {
            return datatables()
                    ->of(SocialMedia::where('socmed_status','=','pending')->get())
                    ->addIndexColumn()
                    ->addColumn('action', function($dataSocialMed){
                        return '<div class="btn-group d-flex">
                        <a href="/adminuniv/socialmedia/'.$dataSocialMed->id.'" class="btn btn-primary mr-3">Detail</a>
                        </div>';
                    })
                    ->addColumn('unit', function($dataSocmed){
                        return $dataSocmed->Unit->unit_name;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('layouts.pages.socialmedia.data-pending');

    }

    public function socMedPublish($id){
        SocialMedia::find($id)->update([
            'socmed_status' => 'published'
        ]);

        Alert::success('Data Published!','Data success published!');
        return redirect('/adminuniv/socialmedia/pending');
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
        return redirect('/adminunit/socialmedia');
    }
}
