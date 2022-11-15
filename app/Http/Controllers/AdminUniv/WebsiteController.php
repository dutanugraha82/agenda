<?php

namespace App\Http\Controllers\AdminUniv;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WebsiteController extends Controller
{
    public function index(){
        if(request()->ajax()) {
            $websites = Website::with('unit')->where('web_status','!=','publish')->orderBy('updated_at','desc')->get();
            return datatables()->of($websites)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    return '<a href="/adminuniv/websites/'.$row->id.'" class="btn btn-success btn-sm">
                                            <i class="fas fa-check-circle"></i>
                                            Verifikasi</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('adminuniv.website.index');
    }

    public function verification($id){
        $website = Website::with('unit')->find($id);
        return view('adminuniv.website.verif',compact('website'));
    }

    public function submit_verification(Request $request,$id) {

        Website::find($id)->update($request->only('web_status','feedback'));
        Alert::success('Berhasil','Artikel situs berhasil di verifikasi');
        return redirect()->route('adminuniv.websites');
    }
}
