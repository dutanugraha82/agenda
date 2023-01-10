<?php

namespace App\Http\Controllers\AdminUnit;

use App\Models\Website;
use App\Models\UnitWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebsiteRequest;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AdminUnit\StoreWebsiteRequest;
use App\Http\Requests\AdminUnit\UpdateWebsiteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

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
                                    return "<a href=".asset('/storage'.'/'.$row->web_thumbnail)." target='_blank'>link</a>"; 

                               })
                               ->addColumn('document',function($row){
                                    return "<a href=".asset('/storage'.'/'.$row->web_document)." target='_blank'>link</a>"; 

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
        $unit = auth()->user()->unit_id;
        $webUnit = UnitWebsite::where('unit_id',$unit)->get();
        $website = \App\Models\Unit::find(auth()->user()->unit_id);
        return view('adminunit.website.create',compact('website','webUnit'));
    }

    public function uploadFilePond(Request $request){
        
        $image = $request->file('image_website')->store('imgWebsite');
        $userId = Auth::id(); 
        DB::table('temporary_image_web')->insert([
            'name'=> $image,
            'users_id' => $userId
        ]);
        return $image;
    }

    public function deleteFilePond(Request $request){
            DB::table('temporary_image_web')->where([
                'name' => $request->image
            ])->delete();
            unlink(public_path('storage'.'/'.$request->image));
            return "deleted";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        Website::create([
            'unit_website_id' => $request->unit_website_id,
            'web_name' => $request->web_name,
            'web_date' => $request->web_date,
            'web_address' => $request->web_address,
            'web_thumbnail' => $request->file('web_thumbnail')->store('thumbnail'),
            'web_document' => $request->file('web_document')->store('document'),
            'web_category' => $request->web_category,
            'unit_id' => auth()->user()->unit_id,
        ]);
        $websiteId = DB::table('websites')->latest('created_at')->first();
        // dd($websiteId->id);
        $dataImage = DB::table('temporary_image_web')->where('users_id','=',Auth::id())->get();
        // dd($websiteId);
        foreach ($dataImage as $item) {
            DB::table('image_website')->insert([
                'image' => $item->name,
                'websites_id' => $websiteId->id
            ]);
        }
        DB::table('temporary_image_web')->where('users_id','=',Auth::id())->delete();
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
