<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use RealRashid\SweetAlert\Facades\Alert;

class SocialMediaController extends Controller
{
    public function index(){
        if(request()->ajax()) {
            $socialMedia = SocialMedia::with('unit')->where('socmed_status','!=','publish')->orderBy('updated_at','desc')->get();
            return datatables()->of($socialMedia)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    return '<a href="/adminuniv/social-media/'.$row->id.'" class="btn btn-success btn-sm">
                                            <i class="fas fa-check-circle"></i>
                                            Verifikasi</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('adminuniv.socialmedia.index');
    }

    public function verification($id){
        $socialMedia = SocialMedia::with('unit')->find($id);
        return view('adminuniv.socialmedia.verif',compact('socialMedia'));
    }

    public function submit_verification(Request $request,$id) {

        SocialMedia::find($id)->update($request->only('socmed_status','feedback'));
        Alert::success('Berhasil','Sosial media berhasil di verifikasi');
        return redirect()->route('adminuniv.social-media');
    }
}
