<?php

namespace App\Http\Controllers\AdminUnit;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Http\Requests\AdminUnit\StoreWebsiteRequest;
use App\Http\Requests\AdminUnit\UpdateWebsiteRequest;
use RealRashid\SweetAlert\Facades\Alert;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {

            $websites = Website::where('unit_id',auth()->user()->unit_id)->orderBy('updated_at','desc')->get();
            return datatables()->of($websites)
                               ->addIndexColumn()
                               ->addColumn('thumbnail',function($row){
                                    return "<a href=". url($row->web_thumbnail)." target='_blank'>link</a>"; 

                               })
                               ->addColumn('document',function($row){
                                    return "<a href=". url($row->web_document)." target='_blank'>link</a>"; 

                               })
                               ->addColumn('action',function($row){
                                return '<div class="d-flex justify-content-start">
                                            <a href="/adminunit/websites/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a> 
                                            <form action='.route('websites.destroy',['website' => $row->id]).' method="POST">
                                                '.csrf_field().'
                                                '.method_field("DELETE").'
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus artikel ?\')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                        ';
                                    
                               })
                               ->rawColumns(['thumbnail','document','action'])
                               ->make(true);
        }

        return view('adminunit.website.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website = \App\Models\Unit::find(auth()->user()->unit_id);
        return view('adminunit.website.create',compact('website'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebsiteRequest $request)
    {
        $website = $request->validated();
        
        $website['web_thumbnail'] = $request->file('web_thumbnail')->store('thumbnail');
        $website['web_document'] = $request->file('web_document')->store('document');
        Website::create($website + ['status' => 'pending','unit_id' => auth()->user()->unit_id]);
        Alert::success('Berhasil!','Artikel berhasil disimpan');
        return redirect()->route('websites.index');
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $website = Website::with('unit')->find($id);

        return view('adminunit.website.edit',compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWebsiteRequest $request, $id)
    {
        $website = $request->validated();

        $prevFiles = Website::find($id);

        if($request->hasFile('web_thumbnail')) {

            unlink(public_path($prevFiles->web_thumbnail));
            
            $website['web_thumbnail'] = $request->file('web_thumbnail')->store('thumbnail');
        }

        if($request->hasFile('web_document')) {

            unlink(public_path($prevFiles->web_document));
            
            $website['web_document'] = $request->file('web_document')->store('document');
        }

        Website::where('id',$id)->update($website);

        Alert::success('Berhasil!','Artikel berhasil disunting');
        return redirect()->route('websites.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = Website::find($id);

        unlink(public_path($website->web_thumbnail));
        unlink(public_path($website->web_document));

        $website->delete();

        
        Alert::success('Berhasil!','Artikel berhasil dihapus');
        return redirect()->route('websites.index');

    }

   
}
