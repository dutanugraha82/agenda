<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\StoreUnitRequest;
use App\Http\Requests\SuperAdmin\StoreSocialMediaRequest;
use App\Models\Unit;
use App\Models\SocMed;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class   UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUnit = Unit::all();
        if(request()->ajax()){
            return datatables()
            ->of($dataUnit)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<div class="d-flex justify-content-start">
                            <a href="/superadmin/unit/'.$row->id.'/socialmedia" class="btn btn-primary btn-sm mr-2">Social Media</a>
                            <a href="/superadmin/unit/'.$row->id.'/edit" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action='.route('unit.destroy',['unit' => $row->id]).' method="POST">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus unit: '.$row->unit_name.'?\')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        ';
                    })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('superadmin.unit.unit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        Unit::create($request->validated());
        Alert::success('Berhasil','Unit berhasil ditambah');
        return redirect('/superadmin/unit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('superadmin.unit.edit',compact('unit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUnitRequest $request, $id)
    {
        Unit::where('id',$id)->update($request->validated());
        Alert::success('Berhasil','Unit berhasil disunting');
        return redirect()->route('unit.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::destroy($id);
        Alert::success('Berhasil','Unit berhasil dihapus');
        return redirect()->back();
    }

    public function select2(Request $request){

            $search = $request->search;

            if($search == ''){
               $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->limit(10)->get();
            }else{
               $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->where('unit_name', 'like', '%' .$search . '%')->limit(10)->get();
            }

            $response = array();
            foreach($units as $unit){
               $response[] = array(
                    "id"=>$unit->id,
                    "text"=>$unit->unit_name
               );
            }

            return response()->json($response);

    }

    public function social_media($id) {
        if(request()->ajax()) {
            $socialMedia = SocMed::where('unit_id',$id)->get();
            return datatables()->of($socialMedia)
                               ->addIndexColumn()
                               ->addColumn('action',function($row){
                                    return '<form action='.route('superadmin.unit.socialmedia-destroy',['id' => $row->id]).' method="POST">
                                                            '.csrf_field().'
                                                            '.method_field("DELETE").'
                                                           <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus sosial media: '.$row->account_name.'?\')">
                                                               Hapus
                                                             </button>
                                            </form>';
                               })
                               ->rawColumns(['action'])
                               ->make(true);
        }

        return view('superadmin.unit.social-media');

    }

    public function social_media_store(StoreSocialMediaRequest $request){

        SocMed::create($request->validated());
        Alert::success('Berhasil!','Sosial media berhasil disimpan');
        return redirect()->back();

    }

    public function social_media_destroy($id) {
        $socialMedia = SocMed::find($id);

        if($socialMedia) {
            $socialMedia->delete();
            Alert::success('Berhasil','social media berhasil dihapus');
            return redirect()->back();
        }

        Alert::error('Gagal','social media tidak ditemukan');
        return redirect()->back();

    }
}
