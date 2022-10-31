<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WebsitesCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->role == 'super_admin'){
            if(request()->ajax()){
                $dataWebsite = Website::where('web_status','=','published')->get();
                return datatables()
                ->of($dataWebsite)
                ->addIndexColumn()
                ->addColumn('Action', function($dataWebsite){
                        return '<div class="container-fluid">
                                <div class="d-flex">
                                <a href="/superadmin/website/'.$dataWebsite->id.'" style="width:5rem;" class="btn btn-primary mr-3">Detail</a>
                                </div>
                                </div>';
                    
                })
                ->rawColumns(['Action'])
                ->make(true);
            }
        }else{

        }

        if(request()->ajax()){
            $dataWebsite = Website::get();
            return datatables()
            ->of($dataWebsite)
            ->addIndexColumn()
            ->addColumn('Action', function($dataWebsite){
                if (auth()->user()->role == "admin_unit") {
                    return '<div class="container-fluid">
                        <div class="d-flex">
                        <a href="/adminunit/website/'.$dataWebsite->id.'" style="width:5rem;" class="btn btn-primary mr-3">Detail</a>
                        <a href="/adminunit/website/'.$dataWebsite->id.'/edit" style="width:5rem;" class="btn btn-warning ml-3">Edit</a>
                        </div>
                        </div>';
                } elseif(auth()->user()->role == "admin_univ") {
                    return '<div class="container-fluid">
                        <div class="d-flex">
                        <a href="/adminuniv/website/'.$dataWebsite->id.'" style="width:5rem;" class="btn btn-primary mr-3">Detail</a>
                        </div>
                        </div>';
                }
                
            })
            ->rawColumns(['Action'])
            ->make(true);
        }
        return view('layouts.pages.website.website');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        return view('layouts.pages.website.input-website',compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebsiteRequest $request)
    {
        $validation = $request->validated();

        // dd($validation);
        $validation['web_thumbnail'] = $request->file('web_thumbnail')->store('web-thumbnail');
        Website::create($validation);
        Alert::success('Success!','Data success stored');

        return redirect('/adminunit/website');
    }

    public function pending(){
        if(request()->ajax()){
            $dataWebsite = Website::where('web_status','=','pending')->get();
            return datatables()
            ->of($dataWebsite)
            ->addIndexColumn()
            ->addColumn('Action', function($dataWebsite){
                if (auth()->user()->role == 'admin_univ') {
                    return '
                        <a href="/adminuniv/website/'.$dataWebsite->id.'" style="width:5rem;" class="btn btn-primary mr-3">Detail</a>
                        ';
                } elseif(auth()->user()->role == 'super_admin') {
                    return '
                        <a href="/superadmin/website/'.$dataWebsite->id.'" style="width:5rem;" class="btn btn-primary mr-3">Detail</a>
                        ';
                }
                
                
            })
            ->rawColumns(['Action'])
            ->make(true);
        }
        return view('layouts.pages.website.data-pending');
    }

    public function published($id){
        Website::find($id)->update([
            'web_status' => 'published'
        ]);
        Alert::success('Data Published!','Data success publish!');
        return redirect('/adminuniv/website'.'/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataWebsite = Website::find($id);
        return view('layouts.pages.website.detail',compact('dataWebsite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataWebsite = Website::find($id);
        $dataUnit = Unit::all();
        return view('layouts.pages.website.edit',compact('dataWebsite','dataUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteRequest $request, $id)
    {
        if($request->file('web_thumbnail')){
            $validation = $request->validated();
            $validation['web_thumbnail'] = $request->file('web_thumbnail')->store('web-thumbnail');
            Storage::delete($request->oldImage);
            Website::find($id)->update($validation);
        }else{
            Website::find($id)->update($request->validated());
        }
        Alert::info('Data Updated!','Data success updated!');
        return redirect('/adminunit/website');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Storage::delete($request->oldImage);
        Website::where('id','=', $id)->delete();
        Alert::warning('Delete Success!','Data success deleted');
        return redirect('/adminunit/website');
    }
}
