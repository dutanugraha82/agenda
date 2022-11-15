<?php

namespace App\Http\Controllers\AdminUnit;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUnit\StoreSocialMediaRequest;
use App\Http\Requests\AdminUnit\UpdateSocialMediaRequest;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use App\Models\SocMed;
use RealRashid\SweetAlert\Facades\Alert;


class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {

            $socialMedia = SocialMedia::where('unit_id',auth()->user()->unit_id)->orderBy('updated_at','desc')->get();
            return datatables()->of($socialMedia)
                               ->addIndexColumn()
                               ->addColumn('thumbnail',function($row){
                                    return "<a href=". url($row->thumbnail)." target='_blank'>link</a>";

                               })
                               ->addColumn('caption',function($row){
                                return "<a href=". url($row->caption)." target='_blank'>link</a>";

                           })
                               ->addColumn('action',function($row){
                                return '<div class="d-flex justify-content-start">
                                            <a href="/adminunit/socialmedia/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <form action='.route('socialmedia.destroy',['social_medium' => $row->id]).' method="POST">
                                                '.csrf_field().'
                                                '.method_field("DELETE").'
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus post sosial media ?\')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                        ';

                               })
                               ->rawColumns(['caption','thumbnail','action'])
                               ->make(true);

        }

        return view('adminunit.socialmedia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $socialMedia = SocMed::where('unit_id',auth()->user()->unit_id)->get();
        return view('adminunit.socialmedia.create',compact('socialMedia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaRequest $request)
    {

        $socialMedia = $request->validated();

        $socialMedia['thumbnail'] = $request->file('thumbnail')->store('thumbnail');
        $socialMedia['caption'] = $request->file('caption')->store('document');

        foreach($request->socmed_url as $url) {

            if(!is_null($url)) {

                SocialMedia::create($socialMedia + ['socmed_url' => $url,'unit_id' => auth()->user()->unit_id,'socmed_status' => 'pending']);
            }

        }
        Alert::success('Berhasil','Post sosial media berhasil disimpan');
        return redirect()->route('socialmedia.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        return view('adminunit.socialmedia.edit',compact('socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialMediaRequest $request, $id)
    {
        $socialMedia = $request->validated();

        $prevFiles = SocialMedia::find($id);

        if($request->hasFile('thumbnail')) {

            unlink(public_path($prevFiles->thumbnail));

            $socialMedia['thumbnail'] = $request->file('thumbnail')->store('thumbnail');
        }

        if($request->hasFile('caption')) {

            unlink(public_path($prevFiles->caption));

            $socialMedia['caption'] = $request->file('caption')->store('document');
        }

        SocialMedia::where('id',$id)->update($socialMedia);

        Alert::success('Berhasil!','Post sosial media berhasil disunting');
        return redirect()->route('socialmedia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SocialMedia::find($id)->delete();
        Alert::success('Berhasil!','Post sosial media berhasil dihapus');
        return redirect()->route('socialmedia.index');
    }
}
